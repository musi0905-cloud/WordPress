"""Idempotent upsert helpers for the 06_MEMORY/*_LIBRARY registries that
WF-03~WF-07 write to. Every registry already exists on disk with the
seed shape {"schema_version": "1.0", "updated_at": null, "<key>": []} —
this module only appends to or updates entries within that existing shape,
it never recreates or reformats a registry file.
"""
from __future__ import annotations

from file_utils import now_iso, project_path, read_json, write_json

# name -> (relative path, list key, id field within each record)
REGISTRY_SPECS: dict[str, tuple[str, str, str]] = {
    "keyword_library": ("06_MEMORY/KEYWORD_LIBRARY/keyword_library.json", "keywords", "keyword_id"),
    "content_inventory": ("06_MEMORY/KEYWORD_LIBRARY/content_inventory.json", "items", "keyword_id"),
    "internal_link_map": ("06_MEMORY/KEYWORD_LIBRARY/internal_link_map.json", "links", "keyword_id"),
    "architecture_registry": ("06_MEMORY/ARCHITECTURE_LIBRARY/architecture_registry.json", "architectures", "keyword_id"),
    "draft_registry": ("06_MEMORY/DRAFT_LIBRARY/draft_registry.json", "drafts", "keyword_id"),
    "source_library": ("06_MEMORY/DRAFT_LIBRARY/source_library.json", "sources", "keyword_id"),
    "quality_registry": ("06_MEMORY/QUALITY_LIBRARY/quality_registry.json", "reviews", "keyword_id"),
    "publication_registry": ("06_MEMORY/PUBLICATION_LIBRARY/publication_registry.json", "publications", "keyword_id"),
    "published_content_index": ("06_MEMORY/PUBLICATION_LIBRARY/published_content_index.json", "content", "keyword_id"),
}


def upsert(registry_name: str, record: dict) -> None:
    if registry_name not in REGISTRY_SPECS:
        raise ValueError(f"unknown registry: {registry_name}")
    rel_path, list_key, id_field = REGISTRY_SPECS[registry_name]
    path = project_path(rel_path)

    data = read_json(path)
    if data is None:
        data = {"schema_version": "1.0", "updated_at": None, list_key: []}
    if list_key not in data:
        data[list_key] = []

    record_id = record.get(id_field)
    if record_id is None:
        raise ValueError(f"record for {registry_name} missing id field '{id_field}'")

    entries = data[list_key]
    for i, existing in enumerate(entries):
        if existing.get(id_field) == record_id:
            merged = dict(existing)
            merged.update(record)
            merged["updated_at"] = now_iso()
            entries[i] = merged
            break
    else:
        record = dict(record)
        record.setdefault("created_at", now_iso())
        record["updated_at"] = now_iso()
        entries.append(record)

    data["updated_at"] = now_iso()
    write_json(path, data)


def find(registry_name: str, keyword_id: str) -> dict | None:
    if registry_name not in REGISTRY_SPECS:
        raise ValueError(f"unknown registry: {registry_name}")
    rel_path, list_key, id_field = REGISTRY_SPECS[registry_name]
    data = read_json(project_path(rel_path)) or {}
    for entry in data.get(list_key, []):
        if entry.get(id_field) == keyword_id:
            return entry
    return None

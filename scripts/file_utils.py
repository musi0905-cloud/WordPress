"""Low-level file I/O helpers shared by every scripts/*.py module.

No workflow logic lives here — only reading/writing YAML/JSON/CSV/Markdown,
path resolution, timestamps, and content hashing for idempotency checks.
"""
from __future__ import annotations

import csv
import hashlib
import json
from datetime import datetime, timezone, timedelta
from pathlib import Path
from typing import Any

import yaml

# scripts/ lives one level below the project root.
PROJECT_ROOT = Path(__file__).resolve().parent.parent

KST = timezone(timedelta(hours=9))


def project_path(*parts: str) -> Path:
    return PROJECT_ROOT.joinpath(*parts)


def ensure_dir(path: Path) -> Path:
    path.mkdir(parents=True, exist_ok=True)
    return path


def now_iso() -> str:
    return datetime.now(tz=KST).isoformat(timespec="seconds")


def run_id(prefix: str) -> str:
    return f"{prefix}-{datetime.now(tz=KST).strftime('%Y%m%d-%H%M%S')}"


def read_yaml(path: Path) -> Any:
    if not path.exists():
        return None
    with path.open("r", encoding="utf-8") as f:
        return yaml.safe_load(f)


def write_yaml(path: Path, data: Any) -> None:
    ensure_dir(path.parent)
    with path.open("w", encoding="utf-8") as f:
        yaml.safe_dump(data, f, allow_unicode=True, sort_keys=False)


def read_json(path: Path) -> Any:
    if not path.exists():
        return None
    with path.open("r", encoding="utf-8") as f:
        return json.load(f)


def write_json(path: Path, data: Any) -> None:
    ensure_dir(path.parent)
    with path.open("w", encoding="utf-8") as f:
        json.dump(data, f, ensure_ascii=False, indent=2)
        f.write("\n")


def write_text(path: Path, text: str) -> None:
    ensure_dir(path.parent)
    path.write_text(text, encoding="utf-8")


def read_csv_rows(path: Path) -> list[dict[str, str]]:
    if not path.exists():
        return []
    with path.open("r", encoding="utf-8-sig", newline="") as f:
        reader = csv.DictReader(f)
        rows = []
        for raw in reader:
            # Blank rows (e.g. trailing newline) show up as all-empty dicts.
            if not any((v or "").strip() for v in raw.values()):
                continue
            rows.append({(k or "").strip(): (v or "").strip() for k, v in raw.items()})
        return rows


def sha256_text(text: str) -> str:
    return hashlib.sha256(text.encode("utf-8")).hexdigest()


def sha256_of(data: Any) -> str:
    """Stable hash of a JSON-serializable structure, used for idempotency."""
    return sha256_text(json.dumps(data, ensure_ascii=False, sort_keys=True))


def slugify(keyword: str) -> str:
    keep = []
    for ch in keyword.strip():
        if ch.isalnum():
            keep.append(ch)
        elif ch in (" ", "-", "_"):
            keep.append("-")
    slug = "".join(keep).strip("-")
    while "--" in slug:
        slug = slug.replace("--", "-")
    return slug[:60] or "keyword"

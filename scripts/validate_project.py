"""Structural integrity check — same categories as a `Content OS 상태`
review, run as a reusable script. Reads and reports only; never writes
to any file under 02_WORKFLOW, 06_MEMORY, or 04_INPUT.

Usage:
    python scripts/validate_project.py
"""
from __future__ import annotations

import sys

from file_utils import project_path
from validators import REQUIRED_ROOT_FILES, scan_for_secret_exposure

WORKFLOW_COUNT = 16
CONFIG_FILES = [
    "04_INPUT/project_config.yaml",
    "04_INPUT/site_config.yaml",
    "04_INPUT/publication_config.yaml",
    "04_INPUT/wordpress_config.yaml",
]
UNSAFE_TRUE_KEYS = ("allow_publish: true", "allow_auto_publish: true", "allow_delete: true")


def check_root_files() -> list[str]:
    missing = [f for f in REQUIRED_ROOT_FILES if not project_path(f).exists()]
    return missing


def check_workflow_files() -> tuple[list[str], list[str]]:
    found = sorted(project_path("02_WORKFLOW").glob("WF-*.md"))
    ids_found = {p.name.split("_")[0] for p in found}
    expected = {f"WF-{i:02d}" for i in range(1, WORKFLOW_COUNT + 1)}
    missing = sorted(expected - ids_found)
    extra = sorted(ids_found - expected)
    return missing, extra


def check_config_files() -> list[str]:
    missing = [f for f in CONFIG_FILES if not project_path(f).exists()]
    return missing


def check_publishing_safety() -> list[str]:
    problems = []
    for rel in ("04_INPUT/publication_config.yaml", "04_INPUT/wordpress_config.yaml"):
        path = project_path(rel)
        if not path.exists():
            continue
        text = path.read_text(encoding="utf-8")
        for bad in UNSAFE_TRUE_KEYS:
            if bad.replace(" ", "") in text.replace(" ", ""):
                problems.append(f"{rel}: found '{bad}'")
    return problems


def main() -> int:
    print("=== Content OS structural validation ===\n")

    missing_root = check_root_files()
    print(f"[root files] missing: {missing_root or 'none'}")

    missing_wf, extra_wf = check_workflow_files()
    print(f"[workflows] missing: {missing_wf or 'none'} / unexpected: {extra_wf or 'none'}")

    missing_cfg = check_config_files()
    print(f"[config files] missing: {missing_cfg or 'none'}")

    unsafe = check_publishing_safety()
    print(f"[publishing safety] violations: {unsafe or 'none'}")

    secret_hits = scan_for_secret_exposure()
    print(f"[secret scan] hits: {secret_hits or 'none'}")

    blocking = missing_root or missing_wf or unsafe or secret_hits
    print("\n=== Result ===")
    print("BLOCKED" if blocking else "READY")
    return 1 if blocking else 0


if __name__ == "__main__":
    sys.exit(main())

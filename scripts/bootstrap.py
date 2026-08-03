"""Idempotent setup for the MVP script layer's own runtime footprint.

Scoped to what scripts/*.py actually needs (05_OUTPUT/{briefs,architecture,
drafts,reviewed,publishing}, 08_LOG/WF-03..07, 10_RUNTIME, the registries
run_content_pipeline.py writes to). All of these already exist in this
repository from the WF-01~WF-16 documentation build, so on a normal run
this script reports everything already in place and creates nothing —
it only creates something on a fresh checkout that's missing a path.
Never overwrites an existing file.
"""
from __future__ import annotations

import sys

from file_utils import ensure_dir, project_path, write_json
from registry_manager import REGISTRY_SPECS

REQUIRED_DIRS = [
    "05_OUTPUT/briefs",
    "05_OUTPUT/architecture",
    "05_OUTPUT/drafts",
    "05_OUTPUT/reviewed",
    "05_OUTPUT/publishing",
    "08_LOG/WF-03",
    "08_LOG/WF-04",
    "08_LOG/WF-05",
    "08_LOG/WF-06",
    "08_LOG/WF-07",
    "10_RUNTIME",
]


def main() -> int:
    created_dirs = []
    for rel in REQUIRED_DIRS:
        path = project_path(rel)
        existed = path.exists()
        ensure_dir(path)
        if not existed:
            created_dirs.append(rel)

    created_registries = []
    for name, (rel_path, list_key, _id_field) in REGISTRY_SPECS.items():
        path = project_path(rel_path)
        if not path.exists():
            write_json(path, {"schema_version": "1.0", "updated_at": None, list_key: []})
            created_registries.append(rel_path)

    print("Bootstrap complete.")
    print(f"  Directories created: {created_dirs or 'none (all already present)'}")
    print(f"  Registries created:  {created_registries or 'none (all already present)'}")
    print("  Existing files were never overwritten.")
    return 0


if __name__ == "__main__":
    sys.exit(main())

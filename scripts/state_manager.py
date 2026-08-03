"""Per-run lock and per-keyword pipeline state.

Deliberately separate from 10_RUNTIME/lock.json and workflow_state.json,
which belong to WF-09_MASTER_ORCHESTRATION and WF-16_FINAL_COMMAND_CENTER
and track WF-01~WF-16 at the workflow level. This MVP script layer tracks
content-level state for the WF-03~WF-07 pipeline only, using the Content
state names already defined in 01_SYSTEM/STATE_MACHINE.md.
"""
from __future__ import annotations

from file_utils import now_iso, project_path, read_json, write_json

STATE_PATH = project_path("10_RUNTIME", "mvp_pipeline_state.json")
LOCK_PATH = project_path("10_RUNTIME", "mvp_pipeline_lock.json")

# Subset of 01_SYSTEM/STATE_MACHINE.md "Content 상태" relevant to WF-03~WF-07.
CONTENT_STATES = [
    "KEYWORD_REGISTERED",
    "BRIEF_PENDING_GENERATION",  # brief scaffold created, semantic fields not yet authored
    "BRIEF_READY",
    "ARCHITECTURE_PENDING_GENERATION",
    "ARCHITECTURE_READY",
    "DRAFT_PENDING_GENERATION",
    "DRAFT_READY",
    "REVIEW_APPROVED",
    "WF05_REVISION_REQUIRED",
    "EXPORT_READY",
    "MANUAL_REVIEW_REQUIRED",
    "BLOCKED",
]


class LockHeldError(RuntimeError):
    pass


def _load_state() -> dict:
    data = read_json(STATE_PATH)
    if not data:
        data = {"schema_version": "1.0", "updated_at": None, "keywords": {}}
    return data


def _save_state(data: dict) -> None:
    data["updated_at"] = now_iso()
    write_json(STATE_PATH, data)


def acquire_lock(run_id: str) -> None:
    lock = read_json(LOCK_PATH) or {"locked": False}
    if lock.get("locked"):
        raise LockHeldError(
            f"mvp_pipeline_lock.json is held by run {lock.get('run_id')} "
            f"(started {lock.get('started_at')}). Refusing to start a concurrent run."
        )
    write_json(LOCK_PATH, {
        "locked": True,
        "run_id": run_id,
        "started_at": now_iso(),
        "heartbeat_at": now_iso(),
    })


def release_lock() -> None:
    write_json(LOCK_PATH, {"locked": False, "run_id": None, "started_at": None, "heartbeat_at": None})


def get_keyword_state(keyword_id: str) -> dict:
    state = _load_state()
    return state["keywords"].get(keyword_id, {
        "keyword_id": keyword_id,
        "status": "KEYWORD_REGISTERED",
        "history": [],
    })


def set_keyword_state(keyword_id: str, status: str, note: str = "", extra: dict | None = None) -> None:
    if status not in CONTENT_STATES:
        raise ValueError(f"unknown content state: {status}")
    state = _load_state()
    entry = state["keywords"].get(keyword_id, {"keyword_id": keyword_id, "status": None, "history": []})
    entry["history"].append({"from": entry.get("status"), "to": status, "at": now_iso(), "note": note})
    entry["status"] = status
    if extra:
        entry.update(extra)
    state["keywords"][keyword_id] = entry
    _save_state(state)

"""CLI entry point for the WF-03~WF-07 MVP pipeline.

    python scripts/run_content_pipeline.py --keyword-id KW-0001
    python scripts/run_content_pipeline.py --all
    python scripts/run_content_pipeline.py --keyword-id KW-0001 --stage brief

Only WF-03 (Keyword Intelligence) -> WF-04 (Content Architecture) ->
WF-05 (Content Generation) -> WF-06 (Quality Review) -> WF-07 (Export,
EXPORT_ONLY) run here. No WordPress API call, no auto-publish, no
Search Console/Analytics/AdSense, no Production Batch, Remediation,
Optimization, or Governance auto-apply — none of that code exists in
this script.

Because the semantic/generative work (search intent judgment, outline
design, prose, quality scoring) needs an LLM this script doesn't call,
every run against a keyword that hasn't had its scaffold files filled
in by hand (or by an LLM session) will stop at the first incomplete
stage rather than fabricate content. That is the correct, intended
behavior, not a bug — see workflow_runner.py's module docstring.
"""
from __future__ import annotations

import argparse
import sys

import state_manager as sm
from file_utils import project_path, read_csv_rows, run_id as make_run_id
from workflow_runner import (
    run_wf03_brief, run_wf04_architecture, run_wf05_draft,
    run_wf06_review, run_wf07_export, StageResult,
)

STAGES = ["brief", "architecture", "draft", "review", "export"]

STOP_STATUSES = {"BLOCKED", "PENDING_CONTENT_GENERATION"}

_READY_STATE_BY_STAGE = {
    "brief": "BRIEF_READY",
    "architecture": "ARCHITECTURE_READY",
    "draft": "DRAFT_READY",
    "review": "REVIEW_APPROVED",
    "export": "EXPORT_READY",
}
_PENDING_STATE_BY_STAGE = {
    "brief": "BRIEF_PENDING_GENERATION",
    "architecture": "ARCHITECTURE_PENDING_GENERATION",
    "draft": "DRAFT_PENDING_GENERATION",
    "review": "MANUAL_REVIEW_REQUIRED",
    "export": "BLOCKED",
}


def _content_state_for(stage: str, result_status: str) -> str:
    if result_status == "COMPLETED":
        return _READY_STATE_BY_STAGE[stage]
    if result_status == "SKIPPED_UNCHANGED":
        return _PENDING_STATE_BY_STAGE.get(stage, "KEYWORD_REGISTERED")
    if result_status == "PENDING_CONTENT_GENERATION":
        return _PENDING_STATE_BY_STAGE[stage]
    return "BLOCKED"


def _load_keyword_rows() -> list[tuple[int, dict]]:
    rows = read_csv_rows(project_path("04_INPUT/keywords.csv"))
    # source_row is 1-indexed against data rows (row 1 = first keyword row),
    # matching WF-03 STEP 02's `source_row` field and this script's KW-0001 assignment.
    return list(enumerate(rows, start=1))


def _run_stage(stage: str, keyword_id: str, row: dict | None, source_row: int | None) -> StageResult:
    if stage == "brief":
        return run_wf03_brief(row, source_row, "04_INPUT/keywords.csv")
    if stage == "architecture":
        return run_wf04_architecture(keyword_id)
    if stage == "draft":
        return run_wf05_draft(keyword_id)
    if stage == "review":
        return run_wf06_review(keyword_id)
    if stage == "export":
        return run_wf07_export(keyword_id)
    raise ValueError(f"unknown stage: {stage}")


def run_for_keyword(keyword_id: str, row: dict | None, source_row: int | None, start_stage: str) -> list[StageResult]:
    results: list[StageResult] = []
    start_index = STAGES.index(start_stage)
    for stage in STAGES[start_index:]:
        result = _run_stage(stage, keyword_id, row, source_row)
        results.append(result)
        sm.set_keyword_state(
            keyword_id,
            _content_state_for(stage, result.status),
            note=result.message,
        )
        if result.status in STOP_STATUSES:
            break
    return results


def main() -> int:
    parser = argparse.ArgumentParser(description="Content OS MVP pipeline (WF-03~WF-07, EXPORT_ONLY)")
    parser.add_argument("--keyword-id", help="e.g. KW-0001 (must already have a Brief for stages after 'brief')")
    parser.add_argument("--all", action="store_true", help="process every row in 04_INPUT/keywords.csv")
    parser.add_argument("--stage", choices=STAGES, default="brief",
                         help="stage to start from when --keyword-id targets an existing keyword "
                              "(ignored for --all, which always starts at 'brief')")
    args = parser.parse_args()

    if not args.keyword_id and not args.all:
        parser.error("pass --keyword-id KW-0001 or --all")

    run_id = make_run_id("PIPELINE")
    try:
        sm.acquire_lock(run_id)
    except sm.LockHeldError as e:
        print(f"REFUSED: {e}")
        return 1

    try:
        all_results: list[StageResult] = []
        if args.all:
            for source_row, row in _load_keyword_rows():
                keyword_id = f"KW-{source_row:04d}"
                all_results.extend(run_for_keyword(keyword_id, row, source_row, "brief"))
        else:
            keyword_id = args.keyword_id
            source_row = int(keyword_id.split("-")[1]) if args.stage == "brief" else None
            row = None
            if args.stage == "brief":
                rows = dict(_load_keyword_rows())
                row = rows.get(source_row)
                if row is None:
                    print(f"No row {source_row} in 04_INPUT/keywords.csv for {keyword_id}")
                    return 1
            all_results.extend(run_for_keyword(keyword_id, row, source_row, args.stage))

        print(f"\n=== Run {run_id} ===")
        for r in all_results:
            print(f"[{r.workflow}] {r.keyword_id}: {r.status}"
                  + (f" — {r.message}" if r.message else "")
                  + (f" | blocking: {r.blocking_issues}" if r.blocking_issues else ""))
        return 0
    finally:
        sm.release_lock()


if __name__ == "__main__":
    sys.exit(main())

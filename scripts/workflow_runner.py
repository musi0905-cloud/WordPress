"""WF-03~WF-07 stage implementations for the Content OS MVP pipeline.

Honesty boundary: this module implements every *mechanical* part of each
workflow (file layout, IDs, registries, handoff records, idempotency,
quality-gate arithmetic) exactly as specified in 02_WORKFLOW/WF-03..07.
It does NOT perform the *semantic* work those workflows actually call
for — judging search intent, designing an outline, writing prose,
scoring factuality. Those steps require an LLM. Every stage that would
need one produces a clearly-marked scaffold file with
`generation.status: REQUIRES_LLM_COMPLETION` and sets `handoff.ready:
False`, and every downstream stage refuses to proceed past an
incomplete upstream stage rather than inventing content. This mirrors
the project's own absolute rule: never fabricate what hasn't actually
been produced.
"""
from __future__ import annotations

from dataclasses import dataclass, field
from pathlib import Path

import registry_manager as reg
from file_utils import (
    now_iso, project_path, read_yaml, write_yaml, write_json, write_text,
    read_json, run_id as make_run_id, sha256_of, slugify,
)
from validators import validate_environment, check_quality_gate

WORKFLOW_VERSION = "1.0"


@dataclass
class StageResult:
    workflow: str
    keyword_id: str
    status: str  # COMPLETED | PENDING_CONTENT_GENERATION | BLOCKED | SKIPPED_UNCHANGED
    output_paths: list[str] = field(default_factory=list)
    handoff: dict = field(default_factory=dict)
    blocking_issues: list[str] = field(default_factory=list)
    message: str = ""


def _handoff(source: str, next_wf: str, ready: bool, inputs: list[str], outputs: list[str],
             blocking: list[str] | None = None, warnings: list[str] | None = None) -> dict:
    return {
        "source_workflow": source,
        "next_workflow": next_wf,
        "status": "READY" if ready else "NOT_READY",
        "ready": ready,
        "input_paths": inputs,
        "output_paths": outputs,
        "blocking_issues": blocking or [],
        "warnings": warnings or [],
        "version": WORKFLOW_VERSION,
        "created_at": now_iso(),
    }


def _log_run(workflow: str, payload: dict) -> Path:
    path = project_path("08_LOG", workflow, f"run_{make_run_id('RUN').split('-', 1)[1]}.json")
    write_json(path, payload)
    return path


# ---------------------------------------------------------------------------
# WF-03 KEYWORD INTELLIGENCE — keyword row -> Content Brief scaffold
# ---------------------------------------------------------------------------

def run_wf03_brief(keyword_row: dict, source_row: int, source_file: str) -> StageResult:
    workflow = "WF-03"
    env = validate_environment(workflow, ["04_INPUT/keywords.csv"])
    keyword = keyword_row.get("keyword", "").strip()
    keyword_id = f"KW-{source_row:04d}"

    if not env.passed:
        return StageResult(workflow, keyword_id, "BLOCKED", blocking_issues=env.blocking_issues)
    if not keyword:
        return StageResult(workflow, keyword_id, "BLOCKED", blocking_issues=["empty keyword cell"])

    slug = slugify(keyword)
    brief_yaml_path = project_path("05_OUTPUT/briefs", f"{keyword_id}_{slug}.yaml")
    brief_md_path = project_path("05_OUTPUT/briefs", f"{keyword_id}_{slug}.md")

    input_hash = sha256_of(keyword_row)
    existing = reg.find("keyword_library", keyword_id)
    if existing and existing.get("input_hash") == input_hash and brief_yaml_path.exists():
        handoff = existing.get("handoff", _handoff(workflow, "WF-04", False, [], [str(brief_yaml_path)]))
        return StageResult(workflow, keyword_id, "SKIPPED_UNCHANGED",
                            output_paths=[str(brief_yaml_path)], handoff=handoff,
                            message="input unchanged since last run — not regenerated")

    def num(field_name: str):
        v = keyword_row.get(field_name, "")
        return float(v) if v not in ("", None) else None

    brief = {
        "schema_version": "1.0",
        "workflow": workflow,
        "keyword_id": keyword_id,
        "keyword": keyword,
        "normalized_keyword": keyword,  # real normalization needs semantic judgment
        "source_row": source_row,
        "source_file": source_file,
        "metrics": {
            "monthly_search_volume": num("monthly_search_volume"),
            "pc_search_volume": num("pc_search_volume"),
            "mobile_search_volume": num("mobile_search_volume"),
            "pc_cpc": num("pc_cpc"),
            "mobile_cpc": num("mobile_cpc"),
        },
        "category_hint": keyword_row.get("category") or None,
        "memo": keyword_row.get("memo") or None,
        "priority_hint": keyword_row.get("priority") or None,
        "search_intent": None,
        "content_purpose": None,
        "target_template": None,
        "risk_assessment": None,
        "information_requirements": [],
        "title_direction": None,
        "outline_direction": [],
        "internal_link_candidates": [],
        "generation": {
            "status": "REQUIRES_LLM_COMPLETION",
            "instructions": (
                "search_intent, content_purpose, target_template, risk_assessment, "
                "information_requirements, title_direction, outline_direction는 "
                "02_WORKFLOW/WF-03_KEYWORD_INTELLIGENCE.md STEP 03~15의 판단 로직을 "
                "따라 채워야 한다. 이 스크립트는 그 판단을 수행하지 않는다."
            ),
        },
        "created_at": now_iso(),
    }

    write_yaml(brief_yaml_path, brief)
    write_text(brief_md_path, (
        f"# Content Brief — {keyword_id}\n\n"
        f"- Keyword: {keyword}\n"
        f"- Status: REQUIRES_LLM_COMPLETION\n\n"
        f"이 파일은 구조적 스캐폴드만 채워졌다. 실제 검색 의도·콘텐츠 목적·목차 방향은 "
        f"아직 생성되지 않았다. 전체 필드는 `{brief_yaml_path.name}` 참조.\n"
    ))

    input_hash_record = {"keyword_id": keyword_id, "input_hash": input_hash}
    reg.upsert("keyword_library", {**input_hash_record, "keyword": keyword, "source_row": source_row,
                                    "category": keyword_row.get("category"), "priority": keyword_row.get("priority")})
    reg.upsert("content_inventory", {"keyword_id": keyword_id, "status": "BRIEF_PENDING_GENERATION",
                                      "brief_path": str(brief_yaml_path.relative_to(project_path()))})

    handoff = _handoff(workflow, "WF-04", ready=False,
                        inputs=["04_INPUT/keywords.csv"],
                        outputs=[str(brief_yaml_path), str(brief_md_path)],
                        blocking=["Brief semantic fields require LLM completion (generation.status)"])
    reg.upsert("keyword_library", {"keyword_id": keyword_id, "handoff": handoff})

    _log_run(workflow, {"workflow": workflow, "keyword_id": keyword_id, "status": "PENDING_CONTENT_GENERATION",
                         "output_paths": handoff["output_paths"], "at": now_iso()})

    return StageResult(workflow, keyword_id, "PENDING_CONTENT_GENERATION",
                        output_paths=handoff["output_paths"], handoff=handoff,
                        message="Brief scaffold created; semantic fields still need LLM completion")


# ---------------------------------------------------------------------------
# WF-04 CONTENT ARCHITECTURE — Brief -> Blueprint scaffold
# ---------------------------------------------------------------------------

def run_wf04_architecture(keyword_id: str) -> StageResult:
    workflow = "WF-04"
    env = validate_environment(workflow, [])
    if not env.passed:
        return StageResult(workflow, keyword_id, "BLOCKED", blocking_issues=env.blocking_issues)

    brief_entry = reg.find("keyword_library", keyword_id)
    if not brief_entry:
        return StageResult(workflow, keyword_id, "BLOCKED",
                            blocking_issues=[f"no Brief found for {keyword_id} — run WF-03 first"])

    brief_path_candidates = list(project_path("05_OUTPUT/briefs").glob(f"{keyword_id}_*.yaml"))
    if not brief_path_candidates:
        return StageResult(workflow, keyword_id, "BLOCKED", blocking_issues=["Brief YAML file not found on disk"])
    brief = read_yaml(brief_path_candidates[0])

    if not brief or brief.get("generation", {}).get("status") != "COMPLETED":
        return StageResult(workflow, keyword_id, "PENDING_CONTENT_GENERATION",
                            blocking_issues=["upstream Brief is not content-complete (generation.status != COMPLETED)"],
                            message="WF-04 will not fabricate an architecture from an incomplete Brief")

    slug = slugify(brief["keyword"])
    arch_yaml_path = project_path("05_OUTPUT/architecture", f"{keyword_id}_{slug}.yaml")
    arch_md_path = project_path("05_OUTPUT/architecture", f"{keyword_id}_{slug}.md")

    architecture = {
        "schema_version": "1.0",
        "workflow": workflow,
        "keyword_id": keyword_id,
        "title": None,
        "slug": None,
        "outline": [],
        "writing_contract": {"structure_locked": True, "sections": []},
        "internal_links": [],
        "faq": [],
        "metadata": {"meta_title": None, "meta_description": None},
        "generation": {
            "status": "REQUIRES_LLM_COMPLETION",
            "instructions": (
                "제목·Slug·H2~H3 구조·섹션별 작성 명세·근거 계획·내부링크·FAQ·메타데이터는 "
                "02_WORKFLOW/WF-04_CONTENT_ARCHITECTURE.md의 판단 로직을 따라 채워야 한다."
            ),
        },
        "created_at": now_iso(),
    }
    write_yaml(arch_yaml_path, architecture)
    write_text(arch_md_path, f"# Content Blueprint — {keyword_id}\n\nStatus: REQUIRES_LLM_COMPLETION\n")

    reg.upsert("architecture_registry", {"keyword_id": keyword_id,
                                          "architecture_path": str(arch_yaml_path.relative_to(project_path()))})
    reg.upsert("content_inventory", {"keyword_id": keyword_id, "status": "ARCHITECTURE_PENDING_GENERATION"})

    handoff = _handoff(workflow, "WF-05", ready=False,
                        inputs=[str(brief_path_candidates[0])],
                        outputs=[str(arch_yaml_path), str(arch_md_path)],
                        blocking=["Architecture requires LLM completion"])
    _log_run(workflow, {"workflow": workflow, "keyword_id": keyword_id, "status": "PENDING_CONTENT_GENERATION", "at": now_iso()})
    return StageResult(workflow, keyword_id, "PENDING_CONTENT_GENERATION",
                        output_paths=handoff["output_paths"], handoff=handoff)


# ---------------------------------------------------------------------------
# WF-05 CONTENT GENERATION — Blueprint -> Draft scaffold
# ---------------------------------------------------------------------------

def run_wf05_draft(keyword_id: str) -> StageResult:
    workflow = "WF-05"
    env = validate_environment(workflow, [])
    if not env.passed:
        return StageResult(workflow, keyword_id, "BLOCKED", blocking_issues=env.blocking_issues)

    arch_entry = reg.find("architecture_registry", keyword_id)
    if not arch_entry:
        return StageResult(workflow, keyword_id, "BLOCKED",
                            blocking_issues=[f"no Architecture found for {keyword_id} — run WF-04 first"])
    arch_candidates = list(project_path("05_OUTPUT/architecture").glob(f"{keyword_id}_*.yaml"))
    architecture = read_yaml(arch_candidates[0]) if arch_candidates else None

    if not architecture or architecture.get("generation", {}).get("status") != "COMPLETED":
        return StageResult(workflow, keyword_id, "PENDING_CONTENT_GENERATION",
                            blocking_issues=["upstream Architecture is not content-complete"],
                            message="WF-05 will not fabricate a draft from an incomplete Blueprint")

    slug = slugify(architecture.get("slug", {}).get("final") or architecture.get("keyword", {}).get("normalized") or keyword_id)
    draft_md_path = project_path("05_OUTPUT/drafts", f"{keyword_id}_{slug}.md")
    draft_json_path = project_path("05_OUTPUT/drafts", f"{keyword_id}_{slug}.json")
    sources_path = project_path("05_OUTPUT/drafts", f"{keyword_id}_{slug}_sources.json")

    write_text(draft_md_path, f"<!-- keyword_id: {keyword_id} — REQUIRES_LLM_COMPLETION, no prose generated -->\n")
    write_json(draft_json_path, {
        "schema_version": "1.0", "workflow": workflow, "keyword_id": keyword_id,
        "word_count": None, "sections": [],
        "generation": {"status": "REQUIRES_LLM_COMPLETION",
                        "instructions": "본문 집필은 WF-05 Writing Contract를 잠금 상태로 따라야 하며 이 스크립트는 수행하지 않는다."},
        "created_at": now_iso(),
    })
    write_json(sources_path, {"schema_version": "1.0", "keyword_id": keyword_id, "sources": []})

    reg.upsert("draft_registry", {"keyword_id": keyword_id,
                                   "draft_path": str(draft_md_path.relative_to(project_path()))})
    reg.upsert("source_library", {"keyword_id": keyword_id, "sources": []})
    reg.upsert("content_inventory", {"keyword_id": keyword_id, "status": "DRAFT_PENDING_GENERATION"})

    handoff = _handoff(workflow, "WF-06", ready=False,
                        inputs=[str(arch_candidates[0])],
                        outputs=[str(draft_md_path), str(draft_json_path), str(sources_path)],
                        blocking=["Draft requires LLM completion"])
    _log_run(workflow, {"workflow": workflow, "keyword_id": keyword_id, "status": "PENDING_CONTENT_GENERATION", "at": now_iso()})
    return StageResult(workflow, keyword_id, "PENDING_CONTENT_GENERATION",
                        output_paths=handoff["output_paths"], handoff=handoff)


# ---------------------------------------------------------------------------
# WF-06 QUALITY REVIEW — Draft -> Quality Report (gate enforced)
# ---------------------------------------------------------------------------

def run_wf06_review(keyword_id: str) -> StageResult:
    workflow = "WF-06"
    env = validate_environment(workflow, [])
    if not env.passed:
        return StageResult(workflow, keyword_id, "BLOCKED", blocking_issues=env.blocking_issues)

    draft_entry = reg.find("draft_registry", keyword_id)
    if not draft_entry:
        return StageResult(workflow, keyword_id, "BLOCKED",
                            blocking_issues=[f"no Draft found for {keyword_id} — run WF-05 first"])
    draft_candidates = list(project_path("05_OUTPUT/drafts").glob(f"{keyword_id}_*.json"))
    draft = read_json(draft_candidates[0]) if draft_candidates else None

    if not draft or draft.get("generation", {}).get("status") != "COMPLETED":
        return StageResult(workflow, keyword_id, "PENDING_CONTENT_GENERATION",
                            blocking_issues=["upstream Draft is not content-complete"],
                            message="WF-06 will not fabricate a quality score for an unwritten draft")

    quality_report_path = project_path("05_OUTPUT/reviewed", f"{keyword_id}_quality_report.json")
    quality_report = {
        "schema_version": "1.0", "workflow": workflow, "keyword_id": keyword_id,
        "weighted_score": None, "critical_issues": None, "major_issues": None,
        "factuality_passed": None, "source_quality_passed": None, "originality_passed": None,
        "policy_passed": None, "html_valid": None,
        "generation": {"status": "REQUIRES_LLM_COMPLETION",
                        "instructions": "21단계 실제 검수는 WF-06 문서를 따라 수행해야 하며 이 스크립트는 점수를 추정하지 않는다."},
        "created_at": now_iso(),
    }
    write_json(quality_report_path, quality_report)

    passed, reasons = check_quality_gate(quality_report)
    reg.upsert("quality_registry", {"keyword_id": keyword_id, "gate_passed": passed,
                                     "quality_report_path": str(quality_report_path.relative_to(project_path()))})
    reg.upsert("content_inventory", {"keyword_id": keyword_id,
                                      "status": "MANUAL_REVIEW_REQUIRED" if not passed else "REVIEW_APPROVED"})

    handoff = _handoff(workflow, "WF-07", ready=passed,
                        inputs=[str(draft_candidates[0])],
                        outputs=[str(quality_report_path)],
                        blocking=reasons)
    _log_run(workflow, {"workflow": workflow, "keyword_id": keyword_id, "gate_passed": passed,
                         "reasons": reasons, "at": now_iso()})
    return StageResult(workflow, keyword_id, "PENDING_CONTENT_GENERATION" if not passed else "COMPLETED",
                        output_paths=handoff["output_paths"], handoff=handoff, blocking_issues=reasons)


# ---------------------------------------------------------------------------
# WF-07 EXPORT (EXPORT_ONLY only — no WordPress) — Quality-gated Export Package
# ---------------------------------------------------------------------------

def run_wf07_export(keyword_id: str) -> StageResult:
    workflow = "WF-07"
    env = validate_environment(workflow, [])
    if not env.passed:
        return StageResult(workflow, keyword_id, "BLOCKED", blocking_issues=env.blocking_issues)

    quality_entry = reg.find("quality_registry", keyword_id)
    if not quality_entry or not quality_entry.get("gate_passed"):
        return StageResult(workflow, keyword_id, "BLOCKED",
                            blocking_issues=["Quality Gate not passed — export is blocked by design (WF-06 must approve first)"])

    export_dir = project_path("05_OUTPUT/publishing", keyword_id)
    manifest_path = export_dir / "export_manifest.json"
    manifest = {
        "schema_version": "1.0", "workflow": workflow, "keyword_id": keyword_id,
        "mode": "EXPORT_ONLY", "wordpress_enabled": False,
        "files": [], "created_at": now_iso(),
    }
    write_json(manifest_path, manifest)

    reg.upsert("publication_registry", {"keyword_id": keyword_id, "mode": "EXPORT_ONLY",
                                         "manifest_path": str(manifest_path.relative_to(project_path()))})
    reg.upsert("published_content_index", {"keyword_id": keyword_id, "public_url": None, "wordpress_post_id": None})
    reg.upsert("content_inventory", {"keyword_id": keyword_id, "status": "EXPORT_READY"})

    handoff = _handoff(workflow, "WF-08", ready=True,
                        inputs=[quality_entry.get("quality_report_path", "")],
                        outputs=[str(manifest_path)])
    _log_run(workflow, {"workflow": workflow, "keyword_id": keyword_id, "status": "COMPLETED", "at": now_iso()})
    return StageResult(workflow, keyword_id, "COMPLETED", output_paths=[str(manifest_path)], handoff=handoff)

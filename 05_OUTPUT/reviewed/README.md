# 05_OUTPUT/reviewed

WF-06_QUALITY_REVIEW가 키워드별로 생성하는 최종 승인 콘텐츠 패키지를 보관한다.

- `KW-0001_<normalized-keyword>_final.md` / `.html` / `.json` — 검수를 통과한 최종 원고
- `KW-0001_<normalized-keyword>_quality_report.md` / `.json` — 품질 심사 리포트 (영역별 점수, 발견된 문제, 등급)
- `KW-0001_<normalized-keyword>_sources_final.json` — 검수 후 확정된 출처 패키지
- `KW-0001_<normalized-keyword>_revision_log.json` — 자동 수정 이력 (수정 사이클, 삭제/완화한 주장, 교체한 출처)

스키마는 `02_WORKFLOW/WF-06_QUALITY_REVIEW.md`의 "7. FINAL JSON STANDARD SCHEMA"를 따른다.

`handoff.status`가 `APPROVED_FOR_EXPORT` 또는 `APPROVED_WITH_PENDING_ASSETS`가 아닌 콘텐츠(`MANUAL_REVIEW_REQUIRED`, `WF05_REVISION_REQUIRED`, `WF04_REVISION_REQUIRED`, `SOURCE_RESEARCH_REQUIRED`, `POLICY_BLOCKED`, `PACKAGE_CORRUPTED`)는 `WF-07_EXPORT_AND_PUBLISHING`으로 자동 전달되지 않는다.

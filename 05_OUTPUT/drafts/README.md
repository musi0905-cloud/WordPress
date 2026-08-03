# 05_OUTPUT/drafts

WF-05_CONTENT_GENERATION이 키워드별로 생성하는 게시 가능한 원고를 보관한다.

- `KW-0001_<normalized-keyword>.md` — Markdown 원고 (frontmatter 포함)
- `KW-0001_<normalized-keyword>.html` — WordPress 호환 시맨틱 HTML
- `KW-0001_<normalized-keyword>.json` — 구조화 Draft 데이터 (섹션별 상태, 품질 점수, handoff 포함)
- `KW-0001_<normalized-keyword>_sources.json` — 이 초안이 사용한 출처 패키지
- `KW-0001_<normalized-keyword>_generation_report.md` — 생성 1회분 리포트

스키마는 `02_WORKFLOW/WF-05_CONTENT_GENERATION.md`의 "7. DRAFT JSON STANDARD SCHEMA"를 따른다.

`handoff.ready: false`(상태 `DRAFT_REVIEW_REQUIRED`)인 Draft는 `WF-06_QUALITY_REVIEW`로 자동 전달되지 않는다.

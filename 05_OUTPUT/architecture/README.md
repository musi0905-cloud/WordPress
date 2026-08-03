# 05_OUTPUT/architecture

WF-04_CONTENT_ARCHITECTURE가 키워드별로 생성하는 Content Blueprint를 보관한다.

- `KW-0001_<normalized-keyword>.yaml` — 운영 데이터 (WF-05가 프로그램적으로 읽는 원본, WF-05 Writing Contract 포함)
- `KW-0001_<normalized-keyword>.md` — 사람이 읽기 위한 요약

YAML 스키마는 `02_WORKFLOW/WF-04_CONTENT_ARCHITECTURE.md`의 "7. BLUEPRINT YAML STANDARD SCHEMA"를 따른다.

`handoff.ready: false`인 Blueprint는 `WF-05_CONTENT_GENERATION`으로 자동 전달되지 않는다.

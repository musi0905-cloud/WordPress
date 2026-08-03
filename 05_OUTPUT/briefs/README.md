# 05_OUTPUT/briefs

WF-03_KEYWORD_INTELLIGENCE가 키워드별로 생성하는 Content Brief를 보관한다.

- `KW-0001_<normalized-keyword>.yaml` — 운영 데이터 (WF-04가 프로그램적으로 읽는 원본)
- `KW-0001_<normalized-keyword>.md` — 사람이 읽기 위한 요약

YAML 스키마는 `02_WORKFLOW/WF-03_KEYWORD_INTELLIGENCE.md`의 "STEP 15.3 YAML 표준 스키마"를 따른다.

`handoff.ready: false`인 브리프는 `WF-04_CONTENT_ARCHITECTURE`로 자동 전달되지 않는다.

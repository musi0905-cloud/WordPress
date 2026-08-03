# Content OS

지속적으로 고품질의 독창적인 콘텐츠를 생산하는 콘텐츠 운영체제(Content OS) 프로젝트.

## 구조

- `00_PROJECT_CONSTITUTION/` — 프로젝트 헌법 (모든 규칙의 최상위 기준)
- `01_SYSTEM/` — 시스템 레벨 설정 (예약)
- `02_WORKFLOW/` — 실행 가능한 Workflow 정의 문서
- `03_REFERENCE/` — 참고 자료 원본 소재
- `04_INPUT/` — Workflow별 실행 입력
- `05_OUTPUT/` — Workflow별 산출물
- `06_MEMORY/` — 프로젝트 영구 자산 (Rule/Reference/Keyword/Quality/Template/Workflow/Knowledge Library)
- `07_TEMPLATE/` — 사람이 정의한 원본 템플릿 (예약)
- `08_LOG/` — Workflow 실행 로그
- `09_ARCHIVE/` — Deprecated/Replaced 자산 이력

## 현재 진행 단계

1. `00_PROJECT_CONSTITUTION` — 완료
2. `WF-01_REFERENCE_ANALYSIS` — 완료 (`02_WORKFLOW/WF-01_REFERENCE_ANALYSIS.md`)
3. `WF-02_RULE_EXTRACTION` 이후 — 예정

## WF-01_REFERENCE_ANALYSIS 사용법

1. `04_INPUT/WF-01/reference_sites.md`에 분석할 참고 사이트를 등록한다 (동일 주제로 2개 이상 권장).
2. `02_WORKFLOW/WF-01_REFERENCE_ANALYSIS.md`를 실행한다.
3. 결과는 `06_MEMORY/RULE_LIBRARY/RULES.md`, `06_MEMORY/REFERENCE_LIBRARY/`, `05_OUTPUT/WF-01/`, `08_LOG/WF-01/`에 누적 저장된다.

전체 운영 원칙은 `00_PROJECT_CONSTITUTION/CONSTITUTION.md`를 따른다.

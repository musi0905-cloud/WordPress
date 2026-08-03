# Content OS

지속적으로 고품질의 독창적인 콘텐츠를 생산하는 콘텐츠 운영체제(Content OS) 프로젝트.

## 구조

- `00_PROJECT_CONSTITUTION/` — 프로젝트 헌법 (모든 규칙의 최상위 기준)
- `01_SYSTEM/` — 시스템 레벨 설정 (예약)
- `02_WORKFLOW/` — 실행 가능한 Workflow 정의 문서
- `03_REFERENCE/` — 참고 자료 원본 소재
- `04_INPUT/` — Workflow별 실행 입력
- `05_OUTPUT/` — Workflow별 산출물
- `06_MEMORY/` — 프로젝트 영구 자산 (Rule/Pattern/Template/Reference/Keyword/Quality/Workflow/Knowledge Library)
- `07_TEMPLATE/` — 사람이 정의한 원본 템플릿 (예약)
- `08_LOG/` — Workflow 실행 로그
- `09_ARCHIVE/` — Deprecated/Replaced 자산 이력

## 자산 계층 구조

```
Reference → Pattern → Rule → DNA → Workflow → Template → Content
```

Rule이 수천 개로 늘어나도 이 계층의 정점인 Content DNA는 압축된 상태로 안정적인 크기를 유지한다. WF-03 이후의 워크플로우는 Rule Library 전체가 아니라 Content DNA와 Decision Tree를 우선 조회한다.

## 현재 진행 단계

1. `00_PROJECT_CONSTITUTION` (v1.1) — 완료
2. `WF-01 : REFERENCE ANALYSIS ENGINE` (v2.0) — 완료 (`02_WORKFLOW/WF-01_REFERENCE_ANALYSIS.md`)
3. `WF-02 : KNOWLEDGE ENGINEERING ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-02_KNOWLEDGE_ENGINEERING.md`)
4. `WF-03_KEYWORD_ANALYSIS` (Keyword Intelligence) 이후 — 예정

## WF-01 : Reference Analysis Engine

WF-01은 **Reference Intelligence Engine**이다. 벤치마킹 사이트를 절대 복사/재작성하지 않고, 구조·레이아웃·정보배치·UX·SEO 패턴만 분석해 프로젝트 자산으로 축적한다. **콘텐츠(글)를 생성하지 않는다** — 이는 이 워크플로우의 핵심 제약이며, 이후 모든 단계의 품질 기준이 이 원칙에서 시작된다.

사용법:

1. `04_INPUT/WF-01/reference_sites.md`에 분석할 참고 사이트를 등록한다 (Rule/Pattern/Template 승격에는 동일 주제 2개 이상 권장).
2. `02_WORKFLOW/WF-01_REFERENCE_ANALYSIS.md`를 실행한다.
3. 결과는 아래에 누적 저장된다.
   - `06_MEMORY/RULE_LIBRARY/RULES.md` — 개별 구조 규칙
   - `06_MEMORY/PATTERN_LIBRARY/PATTERNS.md` — Rule을 묶은 상위 패턴
   - `06_MEMORY/TEMPLATE_LIBRARY/TEMPLATES.md` — 정형화된 문서 골격
   - `06_MEMORY/REFERENCE_LIBRARY/{REF-ID}.md` — 사이트별 구조 분석, Reference Score, Improvement Note
   - `05_OUTPUT/WF-01/{YYYY-MM-DD}_REFERENCE_REPORT.md` — 실행 1회분 종합 리포트
   - `08_LOG/WF-01/{YYYY-MM-DD}.log.md` — 실행 로그

## WF-02 : Knowledge Engineering Engine

WF-02는 Rule을 만들지 않는다. WF-01이 만든 Rule/Pattern/Template을 **Content DNA**(프로젝트의 글쓰기 철학), Knowledge/Pattern Graph, Decision Tree, Template Graph로 압축·구조화한다. Rule이 수천 개가 되어도 사람이 직접 관리하지 않아도 되게 만드는 단계다.

사용법:

1. WF-01이 최소 1개 이상의 Active Rule을 만든 상태여야 한다.
2. (선택) `04_INPUT/WF-02/config.md`로 대상 콘텐츠 유형/압축 강도를 조정한다.
3. `02_WORKFLOW/WF-02_KNOWLEDGE_ENGINEERING.md`를 실행한다.
4. 결과는 아래에 저장된다.
   - `06_MEMORY/KNOWLEDGE_LIBRARY/CONTENT_DNA.md` — 압축된 글쓰기 철학 (핵심 산출물)
   - `06_MEMORY/KNOWLEDGE_LIBRARY/DECISION_TREE.md` — 상황별 Rule/Pattern 자동 선택
   - `06_MEMORY/KNOWLEDGE_LIBRARY/TEMPLATE_GRAPH.md` — 콘텐츠 유형별 완성 Template (CTPL-ID)
   - `06_MEMORY/KNOWLEDGE_LIBRARY/KNOWLEDGE_GRAPH.md`, `PATTERN_GRAPH.md`, `CLASSIFICATION.md`, `VALIDATION_LOG.md`
   - `05_OUTPUT/WF-02/{YYYY-MM-DD}_KNOWLEDGE_REPORT.md` — 실행 1회분 종합 리포트
   - `08_LOG/WF-02/{YYYY-MM-DD}.log.md` — 실행 로그

다음 단계(WF-03_KEYWORD_ANALYSIS)부터는 Rule Library 전체가 아니라 Content DNA와 Decision Tree를 기준으로 동작한다.

전체 운영 원칙은 `00_PROJECT_CONSTITUTION/CONSTITUTION.md`를 따른다.

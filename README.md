# Content OS

지속적으로 고품질의 독창적인 콘텐츠를 생산하는 콘텐츠 운영체제(Content OS) 프로젝트.

## 구조

- `CLAUDE.md` — Claude Code 세션 진입점 (헌법과 WF-09 실행 명령으로 안내)
- `00_PROJECT_CONSTITUTION/` — 프로젝트 헌법 (모든 규칙의 최상위 기준)
- `01_SYSTEM/` — 시스템 레벨 설정 (예약)
- `02_WORKFLOW/` — 실행 가능한 Workflow 정의 문서
- `03_REFERENCE/` — 참고 자료 원본 소재
- `04_INPUT/` — Workflow별 실행 입력
- `05_OUTPUT/` — Workflow별 산출물
- `06_MEMORY/` — 프로젝트 영구 자산 (Rule/Pattern/Template/Reference/Keyword/Quality/Workflow/Knowledge/Architecture/Draft/Publication/Orchestration/Validation/Operations/Performance Library)
- `07_TEMPLATE/` — 사람이 정의한 원본 템플릿 (예약)
- `08_LOG/` — Workflow 실행 로그
- `09_ARCHIVE/` — Deprecated/Replaced 자산 이력, Workflow 재실행 시 이전 버전 스냅샷
- `10_RUNTIME/` — WF-09의 실행 상태 (Lock, 현재 Run, Workflow Queue, Dependency Graph)
- `11_REPORTS/` — WF-09의 프로젝트 전체 실행 보고서
- `12_TEST/` — WF-10의 테스트 전용 환경 (운영 데이터와 물리적으로 분리, Fixture/테스트 산출물/테스트 리포트)
- `13_OPERATIONS/` — WF-11의 실제 운영 환경 (Batch/Queue/Incident/지표/운영 리포트)
- `14_PERFORMANCE/` — WF-12의 실제 성과·애드센스 승인 분석 환경 (색인/검색/AdSense/수익 데이터, Alert, 리포트)

## 자산 계층 구조

```
Reference → Pattern → Rule → DNA → Workflow → Template → Content
```

Rule이 수천 개로 늘어나도 이 계층의 정점인 Content DNA는 압축된 상태로 안정적인 크기를 유지한다. WF-03 이후의 워크플로우는 Rule Library 전체가 아니라 Content DNA와 Decision Tree를 우선 조회한다.

## 현재 진행 단계

1. `00_PROJECT_CONSTITUTION` (v2.1) — 완료
2. `WF-01 : REFERENCE ANALYSIS ENGINE` (v2.0) — 완료 (`02_WORKFLOW/WF-01_REFERENCE_ANALYSIS.md`)
3. `WF-02 : KNOWLEDGE ENGINEERING ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-02_KNOWLEDGE_ENGINEERING.md`)
4. `WF-03 : KEYWORD INTELLIGENCE ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-03_KEYWORD_INTELLIGENCE.md`)
5. `WF-04 : CONTENT ARCHITECTURE ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-04_CONTENT_ARCHITECTURE.md`)
6. `WF-05 : CONTENT GENERATION ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-05_CONTENT_GENERATION.md`)
7. `WF-06 : QUALITY REVIEW ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-06_QUALITY_REVIEW.md`)
8. `WF-07 : EXPORT AND PUBLISHING ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-07_EXPORT_AND_PUBLISHING.md`)
9. `WF-08 : PROJECT LEARNING ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-08_PROJECT_LEARNING.md`)
10. `WF-09 : MASTER ORCHESTRATION ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-09_MASTER_ORCHESTRATION.md`)
11. `WF-10 : SYSTEM VALIDATION AND ACCEPTANCE TEST ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-10_SYSTEM_VALIDATION.md`)
12. `WF-11 : PRODUCTION OPERATIONS ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-11_PRODUCTION_OPERATIONS.md`)
13. `WF-12 : PERFORMANCE AND APPROVAL INTELLIGENCE ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-12_PERFORMANCE_AND_APPROVAL_INTELLIGENCE.md`)

**WF-01~WF-12, 12개 Workflow 정의가 모두 완료되었다.** WF-01~WF-08은 수집 → 압축 → 키워드 설계 → 구조 설계 → 집필 → 검수 → 배포 → 학습이 순환하는 파이프라인, WF-09는 그 8개를 하나의 명령으로 호출·재실행·복구하는 오케스트레이터, WF-10은 그 전체가 설계대로 실제로 동작하는지 `12_TEST/`의 격리된 환경에서 검증하는 품질 게이트, WF-11은 WF-10을 통과한 시스템을 실제 운영(Batch·처리량·비용·Incident·수동 검토)으로 전환하는 운영 계층, WF-12는 그 운영 이후의 실제 색인·검색·애드센스·수익 결과를 수집해 WF-08에 근거 데이터로 되먹임하는 계층이다. WF-09/WF-10/WF-11/WF-12 모두 개별 워크플로우의 판단을 대체하지 않는다 — Handoff가 `ready: false`면 다음 단계로 절대 넘어가지 않는다.

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

## WF-03 : Keyword Intelligence Engine

WF-03은 키워드를 분류/설명하는 단계가 아니다. Content DNA / Decision Tree / Rule Library / Pattern Library / Template Graph / 기존 콘텐츠 목록을 이용해 키워드마다 `WF-04_CONTENT_ARCHITECTURE`가 추가 질문 없이 바로 쓸 수 있는 **Content Brief**를 만든다. 최종 본문은 작성하지 않고, 사용자에게 선택지를 제시하거나 되묻지도 않는다 — 프로젝트 자산을 기준으로 스스로 판단한다.

사용법:

1. WF-01, WF-02가 완료되어 Rule Library와 Content DNA가 존재해야 한다.
2. `04_INPUT/keywords.csv`(또는 `.xlsx`)에 처리할 키워드를 채운다 (열 형식은 `04_INPUT/WF-03_KEYWORDS_README.md` 참조). 키워드의 추가/삭제/교체는 WF-03의 역할이 아니다 — 입력된 키워드만 그대로 처리한다.
3. `02_WORKFLOW/WF-03_KEYWORD_INTELLIGENCE.md`를 실행한다.
4. 결과는 아래에 저장된다.
   - `05_OUTPUT/briefs/KW-XXXX_*.yaml` / `.md` — 키워드별 Content Brief (운영용 YAML + 사람이 읽는 요약)
   - `04_INPUT/processed_keywords/KW-XXXX_*.yaml` — Brief 운영 사본
   - `06_MEMORY/KEYWORD_LIBRARY/keyword_library.json`, `content_inventory.json` — 누적 인덱스
   - `08_LOG/WF-03/environment_validation.json`, `run_<timestamp>.json` — 검증/실행 로그
   - `05_OUTPUT/WF-03_KEYWORD_INTELLIGENCE_REPORT.md` — 실행 1회분 종합 리포트

위험도가 `BLOCKED`이거나 품질 검증(`score < 90`, 3회 재수정 후에도 미통과)을 통과하지 못한 브리프는 `handoff.ready: false`로 표시되며 WF-04로 자동 전달되지 않는다.

## WF-04 : Content Architecture Engine

WF-04는 WF-03의 Content Brief를 실제 글의 구조 설계도(**Content Blueprint**)로 변환한다. 본문은 여전히 쓰지 않지만, 최종 제목·Slug·H1~H3 구조·섹션별 작성 명세·근거 계획·내부링크 위치·이미지 위치·메타데이터·FAQ/구조화 데이터 방향·분량 계획·`WF-05` 집필 계약(Writing Contract)까지 모두 확정해서, WF-05가 추가 판단 없이 그대로 집필할 수 있게 만든다.

사용법:

1. WF-01~WF-03이 완료되어 `handoff.ready: true`인 Content Brief가 `05_OUTPUT/briefs/`에 있어야 한다.
2. `02_WORKFLOW/WF-04_CONTENT_ARCHITECTURE.md`를 실행한다.
3. 결과는 아래에 저장된다.
   - `05_OUTPUT/architecture/KW-XXXX_*.yaml` / `.md` — 키워드별 Content Blueprint (WF-05 Writing Contract 포함)
   - `06_MEMORY/ARCHITECTURE_LIBRARY/architecture_registry.json` — Blueprint 누적 인덱스
   - `06_MEMORY/KEYWORD_LIBRARY/internal_link_map.json`, `content_inventory.json` — 갱신
   - `08_LOG/WF-04/environment_validation.json`, `run_<timestamp>.json` — 검증/실행 로그
   - `05_OUTPUT/WF-04_CONTENT_ARCHITECTURE_REPORT.md` — 실행 1회분 종합 리포트

품질 점수 92점 미만(3회 재수정 후에도 미통과), 또는 카니벌라이제이션 검사 결과가 `MERGE`/`HOLD`/`BLOCK`인 Blueprint는 `WF-05_CONTENT_GENERATION`으로 자동 전달되지 않는다. Blueprint의 `writing_contract.structure_locked: true`가 기본값이며, WF-05는 구조를 임의로 바꿀 수 없다.

## WF-05 : Content Generation Engine

WF-05는 프로젝트에서 실제 본문을 작성하는 첫 워크플로우다. WF-04의 Content Blueprint와 Writing Contract를 잠금 상태로 실행하며, 제목·Slug·H2 구조·검색 의도·내부링크 대상을 임의로 바꾸지 않는다. 근거가 필요한 주장은 출처를 확인해 Fact Package로 연결하고, 확인되지 않은 사실·허구의 경험/후기·AI 탐지 회피 시도·승인/수익 보장 표현은 절대 만들지 않는다.

사용법:

1. WF-01~WF-04가 완료되어 `handoff.ready: true`인 Content Blueprint가 `05_OUTPUT/architecture/`에 있어야 한다.
2. `02_WORKFLOW/WF-05_CONTENT_GENERATION.md`를 실행한다.
3. 결과는 아래에 저장된다.
   - `05_OUTPUT/drafts/KW-XXXX_*.md` / `.html` / `.json` / `_sources.json` / `_generation_report.md` — 키워드별 원고, 출처 패키지, 생성 리포트
   - `06_MEMORY/DRAFT_LIBRARY/draft_registry.json` — Draft 누적 인덱스
   - `06_MEMORY/DRAFT_LIBRARY/source_library.json` — 검증된 출처의 재사용 저장소
   - `06_MEMORY/KEYWORD_LIBRARY/content_inventory.json` — 갱신
   - `08_LOG/WF-05/environment_validation.json`, `run_<timestamp>.json` — 검증/실행 로그
   - `05_OUTPUT/WF-05_CONTENT_GENERATION_REPORT.md` — 실행 1회분 종합 리포트

자기 검증 점수 90점 미만(3회 자동 수정 후에도 미통과), 혹은 Blueprint 자체의 결함·근거 부족·존재하지 않는 내부링크 대상처럼 WF-05가 스스로 고칠 수 없는 문제가 있으면 상태가 `DRAFT_REVIEW_REQUIRED`로 기록되며 `WF-06_QUALITY_REVIEW`로 자동 전달되지 않는다.

## WF-06 : Quality Review Engine

WF-06은 새 글을 기획하지 않는다. WF-05가 만든 Draft Package를 WF-04 Blueprint와 Writing Contract 기준으로 21단계에 걸쳐 심사한다 — 패키지 무결성, 계약/구조 준수, 정보 완결성, 사실성, 출처, 독창성, 가독성, SEO/메타데이터, 내부링크, 시각자료, FAQ/Schema, 정책·저가치 콘텐츠 위험, HTML/기술 구조까지 검사하고, 허용된 범위(맞춤법, 중복 표현, HTML 오류 등) 안에서만 자동 수정한다. 제목·Slug·검색 의도·핵심 H2처럼 계약에 잠긴 요소는 절대 건드리지 않고, 구조적 결함이 발견되면 고치는 대신 WF-04/WF-05로 되돌린다.

사용법:

1. WF-01~WF-05가 완료되어 `handoff.ready: true`인 Draft Package가 `05_OUTPUT/drafts/`에 있어야 한다.
2. `02_WORKFLOW/WF-06_QUALITY_REVIEW.md`를 실행한다.
3. 결과는 아래에 저장된다.
   - `05_OUTPUT/reviewed/KW-XXXX_*_final.md` / `.html` / `.json` — 검수를 통과한 최종 원고
   - `05_OUTPUT/reviewed/KW-XXXX_*_quality_report.md` / `.json`, `_sources_final.json`, `_revision_log.json` — 심사 리포트, 확정 출처, 수정 이력
   - `06_MEMORY/QUALITY_LIBRARY/quality_registry.json` — 심사 누적 인덱스
   - `06_MEMORY/QUALITY_LIBRARY/quality_history.json` — 반복 품질 문제 패턴 (Rule 개정 필요 신호를 `WF-08_PROJECT_LEARNING`용으로 기록, WF-06은 Rule을 직접 고치지 않음)
   - `06_MEMORY/KEYWORD_LIBRARY/content_inventory.json`, `06_MEMORY/DRAFT_LIBRARY/draft_registry.json`, `06_MEMORY/DRAFT_LIBRARY/source_library.json` — 갱신
   - `08_LOG/WF-06/environment_validation.json`, `run_<timestamp>.json` — 검증/실행 로그
   - `05_OUTPUT/WF-06_QUALITY_REVIEW_REPORT.md` — 실행 1회분 종합 리포트

가중 점수 92점 미만이거나 CRITICAL/MAJOR 문제가 하나라도 남아 있으면(점수가 높아도) 통과하지 않는다. 최종 상태는 `APPROVED_FOR_EXPORT` / `APPROVED_WITH_PENDING_ASSETS`(이미지·내부링크 등 자산만 미확정) / `MANUAL_REVIEW_REQUIRED` / `WF05_REVISION_REQUIRED` / `WF04_REVISION_REQUIRED` / `SOURCE_RESEARCH_REQUIRED` / `POLICY_BLOCKED` / `PACKAGE_CORRUPTED` 중 하나로 기록되며, 앞의 두 상태만 `WF-07_EXPORT`로 자동 전달된다.

## WF-07 : Export and Publishing Engine

WF-07은 게시 자동화보다 **안전한 배포 상태 관리**가 핵심이다. WF-06 승인 콘텐츠를 새로 기획하거나 재작성하지 않고, 최종 원고·이미지 자산·내부링크·메타데이터·Schema·WordPress 필드를 하나의 게시 패키지로 조립한다. 기본 게시 모드는 항상 `DRAFT`이며, `04_INPUT/publication_config.yaml`에서 자동 게시를 명시적으로 허용하지 않는 한 절대 자동 공개하지 않는다. WordPress 인증정보는 환경변수에서만 읽고 어떤 산출물·로그에도 기록하지 않으며, 존재하지 않는 URL/Category/Tag/Author/Media는 임의로 만들지 않고 Pending 상태로 남긴다.

사용법:

1. WF-01~WF-06이 완료되어 `handoff.status`가 `APPROVED_FOR_EXPORT` 또는 `APPROVED_WITH_PENDING_ASSETS`인 Final Package가 `05_OUTPUT/reviewed/`에 있어야 한다.
2. (선택) `04_INPUT/publication_config.yaml`(안전 기본값으로 시딩됨)과, WordPress 연동이 필요하면 `04_INPUT/wordpress_config.yaml`(환경변수 이름만 기록, 실제 비밀번호는 절대 기록하지 않음)을 채운다.
3. `02_WORKFLOW/WF-07_EXPORT_AND_PUBLISHING.md`를 실행한다.
4. 결과는 아래에 저장된다.
   - `05_OUTPUT/publishing/KW-XXXX/` — 키워드별 게시 패키지 (최종 원고 사본, WordPress HTML, Payload, Schema, Metadata, 체크리스트, 리포트, WordPress 연동 시 `wordpress_result.json`)
   - `06_MEMORY/PUBLICATION_LIBRARY/publication_registry.json` — 게시 패키지 누적 인덱스
   - `06_MEMORY/PUBLICATION_LIBRARY/published_content_index.json` — 실제 배포된 콘텐츠 색인
   - `06_MEMORY/PUBLICATION_LIBRARY/media_library.json` — 미디어 자산 상태
   - `06_MEMORY/KEYWORD_LIBRARY/content_inventory.json`, `internal_link_map.json` — 갱신
   - `08_LOG/WF-07/environment_validation.json`, `run_<timestamp>.json` — 검증/실행 로그
   - `05_OUTPUT/WF-07_EXPORT_AND_PUBLISHING_REPORT.md` — 실행 1회분 종합 리포트

최종 Publication Mode는 `EXPORT_ONLY` / `WORDPRESS_DRAFT` / `SCHEDULE_READY` / `PUBLISH_READY` / `BLOCKED` 중 하나로 결정되며, WordPress가 비활성이거나 인증정보가 없으면 항상 `EXPORT_ONLY`로 떨어진다. 기존 WordPress Draft가 있으면 새 Post를 만들지 않고 업데이트한다.

## WF-08 : Project Learning Engine

WF-08은 파이프라인의 마지막 단계이자 유일하게 "뒤를 돌아보는" 워크플로우다. 콘텐츠를 새로 쓰거나 게시하지 않고, WF-01~WF-07의 실행 로그·품질 리포트·게시 결과를 분석해 Rule/Pattern/Template/Content DNA/Decision Tree의 실제 성과를 평가한다. 반복 오류를 `ISOLATED`/`REPEATED`/`SYSTEMIC`으로 구분하고, 직접 원인과 상위 원인(예: "WF-06에서 발견된 출처 누락의 진짜 원인은 WF-04의 Evidence Plan 누락")을 추적한다.

자동으로 반영하는 범위는 철저히 좁다 — 오탈자, 상태값, 통계, 경로 같은 PATCH 수준만 자동 적용되며, `risk_level = LOW`이고 데이터 신뢰도가 `HIGH` 이상일 때만 허용된다. Rule 삭제, Content DNA 핵심 철학 변경, 품질/안전 기준 완화, 자동 게시 권한 확대는 **절대 자동 적용되지 않고** `Change Proposal`로만 기록되어 사람의 승인을 기다린다. 모든 자동 변경은 적용 전 스냅샷을 남겨 되돌릴 수 있다. 외부 성과 데이터(검색 노출, 클릭, 수익 등)는 실제로 존재할 때만 분석하며, 없는 데이터를 추정해서 채우지 않는다.

사용법:

1. WF-01~WF-07이 최소 1회 이상 실행되어 로그와 산출물이 존재해야 한다.
2. `02_WORKFLOW/WF-08_PROJECT_LEARNING.md`를 실행한다.
3. 결과는 아래에 저장된다.
   - `06_MEMORY/WORKFLOW_LIBRARY/` — `learning_registry.json`, `rule_performance.json`, `template_performance.json`, `workflow_performance.json`, `content_dna_history.json`, `decision_tree_history.json`, `change_proposals.json`, `project_health.json`, `project_versions.json` (누적 자산 — 헌법 v1.0부터 예약되어 있던 라이브러리를 실제로 채움)
   - `05_OUTPUT/learning/` — `WF-08_LEARNING_REPORT.md`/`.json`, `learning_package.json` 등 실행 1회분 산출물
   - `08_LOG/WF-08/environment_validation.json`, `run_<timestamp>.json` — 검증/실행 로그
   - `09_ARCHIVE/WF-08/<timestamp>/` — PATCH 변경 전 스냅샷 (롤백용)

WF-08 실행 후 다음 WF-01/WF-03 실행부터는 갱신된 Rule 상태·성과 데이터·Decision Tree 보완 경로가 반영된다. 이 시점부터 Content OS는 단순한 파이프라인이 아니라, 스스로의 실행 결과를 근거로 개선되는 학습 가능한 콘텐츠 운영체제가 된다.

## WF-09 : Master Orchestration Engine

WF-09는 WF-01~WF-08 중 어느 것도 대체하지 않는 별도의 제어 계층이다. 각 워크플로우의 선행 조건과 Handoff 상태를 읽어 "지금 실행 가능한 단계"만 순서대로 호출하고, 완료되지 않은 단계 다음으로는 절대 넘어가지 않는다. 실패를 성공으로 표시하지 않고, 품질 미달 콘텐츠를 다음 단계로 넘기지 않으며, 변경되지 않은 워크플로우는 재실행하지 않는다(`UNCHANGED`).

사용법 (명령은 자연어로 내리면 된다, `02_WORKFLOW/WF-09_MASTER_ORCHESTRATION.md`의 "23. COMMAND BEHAVIOR" 참조):

- `Content OS 전체 실행` — WF-01부터 WF-08까지 필요한 단계를 실행한다.
- `Content OS 이어서 실행` / `Content OS 재개` — 마지막 완료 지점부터, 또는 비정상 종료된 Run을 복구해서 이어간다.
- `Content OS 변경분 실행` — 바뀐 입력(키워드, 참고 사이트, 설정, Rule Library 등)이 실제로 영향을 주는 워크플로우만 계산해서 실행한다.
- `Content OS 상태` / `Content OS 차단 목록` — 아무것도 바꾸지 않고 현재 상태·차단 원인만 보고한다.
- `WF-05 실행`, `Content OS 키워드 실행: KW-0001` — 특정 워크플로우 또는 특정 키워드만 지정 실행한다.
- `Content OS 전체 실행 미리보기` — Dry Run. 실행 계획만 계산하고 파일/WordPress를 전혀 건드리지 않는다.

결과는 아래에 저장된다.

- `10_RUNTIME/` — `lock.json`(중복 실행 방지), `workflow_state.json`(WF-01~WF-08 각각의 현재 상태), `workflow_queue.json`, `dependency_graph.json`, `recovery_plan.json`
- `11_REPORTS/MASTER_EXECUTION_REPORT.md` / `.json` — Run 전체 요약 (Workflow별 결과, 콘텐츠 처리 현황, 프로젝트 건강도)
- `06_MEMORY/ORCHESTRATION_LIBRARY/` — Run 이력(`orchestration_registry.json`), 실행 이벤트(`execution_history.json`), 복구 이력(`recovery_history.json`)
- `08_LOG/WF-09/` — 검증/실행 로그, Workflow Event 로그

재시도·반환 경로에는 한도가 있다 — 동일 콘텐츠가 WF-04~WF-07 사이를 무한히 오가지 않도록 워크플로우별 최대 재실행 횟수(WF-04 2회, WF-05 3회, WF-06 3회, WF-07 동기화 2회, 콘텐츠당 총 반환 5회)를 초과하면 `MANUAL_REVIEW_REQUIRED`로 넘어간다. WordPress 인증정보는 WF-09 자신도 출력하거나 저장하지 않으며, 자동 게시 권한을 임의로 확대하지 않는다.

## WF-10 : System Validation and Acceptance Test Engine

WF-10은 운영 콘텐츠를 대량 생성하지 않는다. 대신 `12_TEST/`라는 운영 데이터와 물리적으로 분리된 환경에서 최소 Fixture(참고 사이트 1건, 정상 키워드 1건, 고위험 키워드 1건, 의도적으로 깨진 파일 6종)로 WF-01~WF-09 전체가 설계대로 연결되고 동작하는지 시험한다 — 구조/Schema/Contract/Dependency 정적 검사부터 WF-01~WF-09 개별 Unit Test, 워크플로우 간 연결 Integration Test, 샘플 키워드 1개로 전체 파이프라인을 통과시키는 End-to-End Test, 의도적 오류 주입, 복구 경로, Retry/Loop 한도, 보안(Secret 노출), WordPress 안전성(MOCK/SANDBOX/DRAFT_ONLY만 허용), 동일 입력 재실행 시 중복 여부(Idempotency), Archive/Rollback, 그리고 이전 Baseline 대비 회귀(Regression)까지 검사한다.

사용법:

1. WF-01~WF-09가 정의되어 있어야 한다 (실행되어 있을 필요는 없다 — WF-10이 Fixture로 직접 시험한다).
2. `02_WORKFLOW/WF-10_SYSTEM_VALIDATION.md`를 실행한다 (전체 테스트, 빠른 테스트, 특정 워크플로우 테스트, 보안 테스트 등 명령은 문서의 "12. COMMAND BEHAVIOR" 참조).
3. 결과는 아래에 저장된다.
   - `12_TEST/reports/ACCEPTANCE_REPORT.md` 등 — 이번 Test Run의 전체 판정과 영역별 리포트
   - `12_TEST/test_registry.json` — 이번 Run의 테스트 결과 레지스트리
   - `06_MEMORY/VALIDATION_LIBRARY/system_validation_registry.json`, `test_history.json`, `regression_baseline.json` — Test Run 누적 이력과 회귀 기준선
   - `08_LOG/WF-10/environment_validation.json`, `run_<timestamp>.json` — 검증/실행 로그

최종 판정은 `ACCEPTED` / `ACCEPTED_WITH_WARNINGS` / `CONDITIONALLY_ACCEPTED`(예: WordPress 연동은 실패해도 Export는 정상이면 그 범위만 운영 가능) / `REJECTED` / `BLOCKED` 중 하나다. Critical 또는 Major 실패가 하나라도 있으면 `ACCEPTED`가 될 수 없으며, WF-10은 통과율을 높이기 위해 품질·보안·Handoff·Retry·Loop 기준 자체를 낮추지 않는다 — 테스트가 실패하면 프로젝트를 고치는 것이지, 테스트 기준을 고치는 것이 아니다.

## WF-11 : Production Operations Engine

WF-11은 WF-10을 통과한 Content OS를 실제 운영으로 전환한다. 새 콘텐츠 전략을 만들지 않고, Workflow 정의를 바꾸지 않고, 품질 기준을 낮추지 않는다 — 대신 **얼마나, 언제, 어떤 순서로** 처리할지를 관리한다. 모든 개별 Workflow 실행은 WF-09를 거치며, WF-11 자신은 Batch 편성, 처리량/비용 상한, 실패·재시도, Incident 대응, 수동 검토 대기열, WordPress 초안 동기화, 운영 지표만 관장한다.

운영은 WF-10 최근 결과가 `ACCEPTED` / `ACCEPTED_WITH_WARNINGS` / `CONDITIONALLY_ACCEPTED`(허용된 기능만) 중 하나이고 기본 30일 이내일 때만 시작된다. `REJECTED`/`BLOCKED`이거나 만료되었으면 절대 시작하지 않는다. 처리량에는 항상 상한이 있다(기본: Batch당 키워드 5개, 동시 처리 1건, 일일 초안 10건/WordPress 동기화 10건, 항목당 재시도 2회) — 무제한 확장은 금지 항목이다. 게시 기본값은 운영 환경에서도 항상 `WORDPRESS_DRAFT`이며, 예약/공개는 정책 명시적 허용 + WF-06 승인 + WF-07 패키지 검증 + WF-10 WordPress Safety 통과 + 자산 해결 + 수동 검토 충족 + 게시 일정 규칙 존재까지 모두 갖춰야 가능하다.

사용법 (명령은 자연어로, `02_WORKFLOW/WF-11_PRODUCTION_OPERATIONS.md`의 "18. COMMAND BEHAVIOR" 참조):

- `Content OS 운영 초기화` — 운영 폴더·설정·Registry만 구성한다 (실행은 시작하지 않음).
- `Content OS 운영 시작` / `Content OS 다음 Batch` — 신규 입력을 탐지해 Batch를 만들고 WF-09를 통해 실행한다.
- `Content OS 운영 상태` / `Content OS 수동 검토 목록` — 아무것도 바꾸지 않고 현재 상태·대기열만 보고한다.
- `Content OS 운영 일시 중단` / `Content OS 운영 재개` / `Content OS 운영 복구` — 안전 정지, 재개, 비정상 종료 복구.
- `Content OS 유지보수 모드` — 신규 Batch 생성만 중단하고 현재 상태를 보존한다.

결과는 아래에 저장된다.

- `13_OPERATIONS/config/` — 운영 정책 6종 (Batch/비용/모니터링/Incident/보존 — 모두 안전 기본값으로 시딩됨)
- `13_OPERATIONS/runtime/`, `13_OPERATIONS/queue/` — 현재 운영 상태, Production Lock, 4종 대기열(Production/Manual Review/WordPress Sync/Learning)
- `13_OPERATIONS/incidents/`, `13_OPERATIONS/metrics/`, `13_OPERATIONS/reports/` — Incident 기록, 지표, Batch/Daily 운영 리포트
- `06_MEMORY/OPERATIONS_LIBRARY/` — Operations Run 누적 인덱스, Batch 이력, 운영 건강도, 수동 검토 이력
- `08_LOG/WF-11/` — 검증/실행/이벤트 로그

Secret 노출, 무단 자동 공개, 운영 데이터 손상, 품질 Gate 우회, 정책 차단 콘텐츠 게시, Registry 전체 손상은 모두 `CRITICAL` Incident로 분류되며 발생 즉시 운영을 중단하고 자동 복구를 금지한다 — 재개하려면 WF-10 재검증이 필요하다.

## WF-12 : Performance and Approval Intelligence Engine

WF-12는 콘텐츠를 만들지도 게시하지도 않는, 순수하게 "실제로 무슨 일이 일어났는가"를 확인하는 계층이다. 색인 상태, 검색 노출/클릭/CTR/순위, 사용자 참여, 애드센스 신청·승인·거절·재신청 이력, 승인 후 수익까지 실제 데이터가 있을 때만 분석한다. 존재하지 않는 지표는 절대 추정하지 않고 `data_status: UNAVAILABLE`로 기록하며, 애드센스 승인/거절은 공식 출처(대시보드 상태, 공식 통지, 검증된 내보내기)로만 확정한다 — 예측이나 정황만으로는 절대 확정하지 않는다. 상관관계 분석은 허용하지만("이 Template을 쓴 글의 색인율이 더 높다") 인과관계 단정("이 Rule *때문에* 승인되었다")은 명시적으로 금지된다.

사용법 (명령은 자연어로, `02_WORKFLOW/WF-12_PERFORMANCE_AND_APPROVAL_INTELLIGENCE.md`의 "14. COMMAND BEHAVIOR" 참조):

- `WF-12 전체 실행` — 사용 가능한 모든 성과·애드센스 데이터를 분석한다.
- `WF-12 색인 분석` / `WF-12 검색 성과` / `WF-12 애드센스 분석` — 특정 영역만 분석한다.
- `WF-12 승인 결과 반영` — `14_PERFORMANCE/intake/adsense/`와 `manual_results/`에 실제로 존재하는 결과만 반영한다.
- `WF-12 콘텐츠 분석: KW-0001` / `WF-12 사이트 분석: SITE-0001` — 특정 범위만 분석한다.
- `WF-12 상태` / `WF-12 Alert 목록` — 아무것도 바꾸지 않고 현재 상태·열린 Alert만 보고한다.

외부 데이터는 `14_PERFORMANCE/intake/`(Search Console/Analytics/WordPress/AdSense/색인/수동 결과, CSV/JSON/XLSX/YAML/TXT/HTML/PDF 허용)에 넣으면 탐지된다. 결과는 아래에 저장된다.

- `14_PERFORMANCE/normalized/` — 표준화된 콘텐츠/쿼리/페이지/색인/애드센스/수익 데이터
- `14_PERFORMANCE/reports/` — Performance/Indexing/AdSense Approval/Content Performance/Site Health 리포트
- `14_PERFORMANCE/alerts/` — 이상 징후 Alert (색인 급감, Robots 전역 차단, 애드센스 정책 경고 등은 `CRITICAL`)
- `06_MEMORY/PERFORMANCE_LIBRARY/` — Performance Run 이력, 콘텐츠 성과 이력, 애드센스 신청/승인 변경 이력, 수익 이력
- `06_MEMORY/PERFORMANCE_LIBRARY/performance_learning_queue.json` — WF-08에 전달되는 학습 패키지 (WF-12는 여기까지만 하고, Rule/Content DNA 변경 판단은 WF-08의 몫이다)

WF-12는 짧은 관찰 기간의 데이터를 실패로 단정하지 않고(`INSUFFICIENT_OBSERVATION_PERIOD`), 색인 지연을 자동으로 품질 문제로 판단하지 않으며, 표본이 부족한 Rule/Template/Workflow 비교는 학습 후보로 전달하지 않는다.

전체 운영 원칙은 `00_PROJECT_CONSTITUTION/CONSTITUTION.md`를 따른다.

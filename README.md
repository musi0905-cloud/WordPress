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

1. `00_PROJECT_CONSTITUTION` (v1.6) — 완료
2. `WF-01 : REFERENCE ANALYSIS ENGINE` (v2.0) — 완료 (`02_WORKFLOW/WF-01_REFERENCE_ANALYSIS.md`)
3. `WF-02 : KNOWLEDGE ENGINEERING ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-02_KNOWLEDGE_ENGINEERING.md`)
4. `WF-03 : KEYWORD INTELLIGENCE ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-03_KEYWORD_INTELLIGENCE.md`)
5. `WF-04 : CONTENT ARCHITECTURE ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-04_CONTENT_ARCHITECTURE.md`)
6. `WF-05 : CONTENT GENERATION ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-05_CONTENT_GENERATION.md`)
7. `WF-06 : QUALITY REVIEW ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-06_QUALITY_REVIEW.md`)
8. `WF-07 : EXPORT AND PUBLISHING ENGINE` (v1.0) — 완료 (`02_WORKFLOW/WF-07_EXPORT_AND_PUBLISHING.md`)
9. `WF-08_PROJECT_LEARNING` (Learning Engine) — 예정

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

전체 운영 원칙은 `00_PROJECT_CONSTITUTION/CONSTITUTION.md`를 따른다.

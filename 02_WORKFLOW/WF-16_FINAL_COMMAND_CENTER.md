============================================================
WF-16
FINAL COMMAND CENTER AND CLAUDE INTEGRATION ENGINE
Version 1.0
Parent: PROJECT CONSTITUTION
Prerequisite: WF-01 ~ WF-15
Final Workflow of Content OS
============================================================

# 0. CONSTITUTION BINDING

이 워크플로우는 `00_PROJECT_CONSTITUTION/CONSTITUTION.md`를 최상위 규범으로 삼는다. 충돌 시 헌법이 우선한다.

이 워크플로우는 이 문서 하나만으로 독립적으로 실행 가능한 하나의 프로젝트다. 이 문서 밖의 대화 맥락에 의존하지 않는다.

이 단계가 완료되면 사용자는 개별 Workflow 파일을 직접 찾아 실행할 필요 없이 `CLAUDE.md`를 통해 초기화, 콘텐츠 생성, 검수, WordPress 초안 생성, 성과 분석, 승인 거절 대응, 최적화, 운영 복구까지 통합 명령으로 처리할 수 있다. WF-16은 Content OS의 마지막 워크플로우이며, WF-01~WF-15 어느 것의 책임도 대체하지 않는다 — 대신 이들이 하나의 진입점과 하나의 명령 체계 아래에서 실행되도록 통합한다.

# 0.1 ASSET PATH MAPPING

이 문서는 WF-09~WF-15와 동일한 표준 레이아웃(`Content-OS/`)을 가정한다. 앞선 문서들의 매핑을 상속하며, WF-16 전용 항목만 아래에 추가한다.

| 이 문서가 가정하는 표준 경로 | 실제 프로젝트 경로 |
|---|---|
| `00_PROJECT_CONSTITUTION.md` | `00_PROJECT_CONSTITUTION/CONSTITUTION.md` |
| `CLAUDE.md` | 저장소 루트 `CLAUDE.md` — 이미 WF-01 도입 시점부터 존재하며, 본 워크플로우가 "7. FINAL CLAUDE.MD STANDARD"에 맞춰 최종본으로 재작성한다 (기존 내용을 무단 삭제하지 않고 최종 표준에 맞게 갱신) |
| `01_SYSTEM/SYSTEM_PROMPT.md`, `CORE_RULES.md`, `QUALITY_GATE.md`, `ERROR_POLICY.md`, `COMMAND_ROUTER.md`, `STATE_MACHINE.md`, `SECURITY_POLICY.md`, `HANDOFF_POLICY.md` | 동일 경로. `01_SYSTEM/`은 WF-01부터 "향후 확장을 위한 예약 디렉터리"(README.md만 존재)였으며, 본 워크플로우가 최초로 실제 내용을 채운다 |
| `02_WORKFLOW/WF-01_*.md` ~ `WF-16_*.md` | 동일 경로 (파일명은 각 워크플로우 문서 참조) |
| `06_MEMORY/content_dna.yaml`, `knowledge_graph.json`, `decision_tree.yaml`, `rule_library.json`, `pattern_library.json`, `template_graph.json`, `keyword_library.json`, `content_inventory.json`, `internal_link_map.json`, `source_library.json`, `architecture_registry.json`, `draft_registry.json`, `quality_registry.json`, `publication_registry.json`, `performance_registry.json`, `remediation_registry.json`, `optimization_registry.json`, `governance_registry.json` | 앞선 WF-01~WF-15 문서들의 Asset Path Mapping을 그대로 상속한다 (각 `_LIBRARY/` 하위 경로, WF-09~WF-15 "0.1 ASSET PATH MAPPING" 참조) |
| `06_MEMORY/operations_registry.json` | `06_MEMORY/OPERATIONS_LIBRARY/operations_registry.json` |
| `06_MEMORY/orchestration_registry.json` | `06_MEMORY/ORCHESTRATION_LIBRARY/orchestration_registry.json` |
| `06_MEMORY/project_versions.json` | `06_MEMORY/WORKFLOW_LIBRARY/project_versions.json` (WF-08이 예약한 기존 파일 — 본 워크플로우가 `1.0.0` Initial Integrated Release로 갱신) |
| `06_MEMORY/system_validation_registry.json` | `06_MEMORY/VALIDATION_LIBRARY/system_validation_registry.json` |
| `06_MEMORY/final_integration_registry.json`, `command_history.json`, `system_capability_registry.json` | `06_MEMORY/COMMAND_CENTER_LIBRARY/` 하위 동일 파일명 (본 워크플로우 전용 신규 라이브러리) |
| `10_RUNTIME/*`, `11_REPORTS/*` | 동일 위치. WF-09가 WF-01~WF-08 범위로 만든 `dependency_graph.json`, `workflow_state.json`을 본 워크플로우가 WF-01~WF-16 전체 범위로 확장하며, 기존 값을 삭제하지 않는다 |
| `03_REFERENCE/benchmark_list.xlsx`, `04_INPUT/keywords.xlsx`, `keywords.json`, `07_TEMPLATE/*` | 현재 저장소에는 대응 형식(`keywords.csv` 등)만 존재하거나 아직 생성되지 않은 선택 입력/예약 자산이다. 존재하지 않는다고 실행을 차단하지 않는다 |

------------------------------------------------------------

# 1. ROLE

당신은 Content OS의 `Final Command Center and Claude Integration Engine`이다.

당신의 역할은 지금까지 구축된 `WF-01`부터 `WF-15`까지의 Workflow, System Rule, Memory, Registry, Configuration, Runtime, Test, Operations, Performance, Remediation, Optimization, Governance 구조를 하나의 최종 실행 체계로 통합하는 것이다.

당신은 개별 Workflow의 역할을 대체하지 않는다.

당신은 모든 Workflow가 하나의 프로젝트 규칙과 상태 체계 아래에서 실행되도록 다음을 구성한다.

- 최종 `CLAUDE.md`
- 최종 System Prompt
- 통합 Command Router
- 프로젝트 Bootstrap
- 프로젝트 초기화 명령
- Workflow 실행 명령
- 전체 자동 실행 명령
- Keyword 단위 실행 명령
- Batch 운영 명령
- WordPress 초안 동기화 명령
- 상태 확인 명령
- 실패 복구 명령
- 애드센스 거절 대응 명령
- 콘텐츠 최적화 명령
- 성과 분석 명령
- Governance 명령
- 테스트 명령
- 안전한 중단 및 재개
- Runtime 상태 관리
- 최종 프로젝트 구조 검증
- 문서 및 설정 연결 검증
- 운영자용 Command Reference
- 프로젝트 인수인계 문서

이 Workflow의 최종 목적은 사용자가 프로젝트의 내부 구조를 모두 기억하지 않아도, 하나의 최종 명령 체계를 통해 Content OS 전체를 실행하고 관리할 수 있도록 만드는 것이다.

------------------------------------------------------------

# 2. FINAL OBJECTIVE

전체 Content OS를 다음 구조로 완성한다.

```text
User Command
↓
CLAUDE.md
↓
Command Router
↓
Project State Detection
↓
Safety and Permission Check
↓
WF-09 Master Orchestrator
↓
Required Workflow Execution
↓
WF-10 Validation
↓
WF-11 Production Operations
↓
WF-12 Performance Analysis
↓
WF-13 Remediation
↓
WF-14 Optimization
↓
WF-15 Governance
↓
Unified Status and Report
```

사용자는 최종적으로 다음과 같은 명령만으로 시스템을 사용할 수 있어야 한다.

```text
Content OS 초기화
Content OS 전체 실행
Content OS 운영 시작
Content OS 키워드 실행: KW-0001
Content OS WordPress 초안 생성
Content OS 애드센스 상태 분석
Content OS 애드센스 거절 대응
Content OS 콘텐츠 최적화
Content OS 전체 테스트
Content OS 상태
Content OS 운영 상태
Content OS 복구
Content OS 변경 제안 검토
```

------------------------------------------------------------

# 3. ABSOLUTE OPERATING RULES

## 3.1 사용자에게 불필요한 질문을 하지 않는다

프로젝트 파일, 설정, Memory, Registry, 실행 이력을 통해 판단 가능한 내용을 사용자에게 다시 묻지 않는다.

다음을 금지한다: 이미 제공된 키워드 재요청 / 이미 등록된 사이트 정보 재요청 / 이미 설정된 WordPress 상태 재질문 / 실행 가능한 Workflow 선택 요청 / 다음 단계 선택 요청 / 프로젝트 폴더 위치가 명확한데 다시 질문 / 오류 원인이 로그에 있는데 사용자에게 원인 질문 / 같은 내용을 반복 확인

필수 정보가 실제로 존재하지 않고 자동 판단도 불가능한 경우에는 해당 기능만 차단하고, 나머지 작업은 계속 수행한다.

## 3.2 하나의 명령으로 전체 흐름을 처리한다

사용자가 전체 실행을 요청하면 다음을 자동 수행한다.

```text
현재 상태 확인
↓
누락된 구조 확인
↓
필요한 선행 Workflow 계산
↓
실행 Queue 생성
↓
Workflow 실행
↓
품질 검수
↓
Export 또는 WordPress Draft
↓
운영 기록
↓
학습
↓
최종 보고
```

사용자가 각 Workflow를 일일이 호출하도록 요구하지 않는다.

## 3.3 개별 Workflow 책임을 침범하지 않는다

각 문제는 담당 Workflow에 전달한다.

```text
Reference 분석 → WF-01
Knowledge, Rule, Pattern, Content DNA → WF-02
Keyword, Intent, Brief → WF-03
Architecture, Outline, Writing Contract → WF-04
본문, 출처, Draft → WF-05
품질, 사실성, 정책, HTML 검수 → WF-06
Export, WordPress Draft, Schema → WF-07
학습, Rule 성과, Project Health → WF-08
전체 실행, Queue, Dependency, Recovery → WF-09
System Test, Acceptance, Regression → WF-10
Production Batch, 운영, Incident → WF-11
검색 성과, 색인, 애드센스 결과 → WF-12
승인 거절, 색인, 사이트 문제 수정 → WF-13
게시 후 콘텐츠 최적화 → WF-14
Rule, Workflow, Config 변경 통제 → WF-15
```

## 3.4 승인과 수익을 보장하지 않는다

다음을 금지한다: 애드센스 승인 보장 / 특정 콘텐츠 수로 승인 확정 / 특정 기간 안에 승인 확정 / 검색 상위 노출 보장 / 트래픽 보장 / 광고 수익 보장 / 특정 월 수익 보장 / 벤치마킹 사이트 복제로 승인 확정

Content OS는 품질, 운영, 검증, 분석, 개선을 자동화하지만 외부 플랫폼의 결과를 통제하지 않는다.

## 3.5 벤치마킹 사이트를 복제하지 않는다

다음을 금지한다: 제목 복제 / 문장 복제 / 문단 복제 / 목차 순서 복제 / 사례 복제 / 고유 표현 복제 / 디자인 복제 / 브랜드 복제 / 이미지 복제

벤치마킹 결과는 다음 형태의 추상화된 자산으로만 활용한다: Rule / Pattern / Template / Content DNA / Information Flow / Trust Strategy / Evidence Strategy / User Experience Principle

## 3.6 안전한 게시를 기본값으로 한다

기본 게시 범위: `EXPORT_ONLY` 또는 `WORDPRESS_DRAFT`

다음은 명시적 권한과 검증이 없으면 수행하지 않는다: Publish / Schedule / Delete / Noindex / Redirect / Merge / AdSense 신청 / AdSense 재신청

## 3.7 Secret을 출력하거나 저장하지 않는다

다음을 어떤 산출물에도 기록하지 않는다: WordPress Password / Application Password / API Token / Authorization Header / Cookie / Session Token / Database Password / Private Key / AdSense Credential / Search Console Credential / Analytics Credential

환경변수 이름과 존재 여부만 기록한다.

## 3.8 변경은 Governance를 거친다

다음 자산의 변경은 WF-15를 거친다: Project Constitution / System Prompt / Core Rule / Content DNA / Rule Library / Template Graph / Decision Tree / Workflow / Quality Gate / Security Policy / Publication Policy / Registry Schema / 자동화 권한

## 3.9 품질 기준을 처리량보다 우선한다

다음을 금지한다: 품질 검수 생략 / 출처 검증 생략 / 품질 점수 하향 / 대량 생성 우선 / 미검증 콘텐츠 배포 / 정책 문제 강제 진행 / 사실성 문제 무시 / 중복 콘텐츠 대량 생성

## 3.10 모든 변경은 추적 가능해야 한다

다음을 반드시 기록한다: 누가 생성했는가가 아니라 어떤 Workflow가 생성했는가 / Input / Output / Version / Hash / 상태 / Handoff / 오류 / 수정 이력 / Archive 위치 / Rollback 위치 / 실행 시간 / 프로젝트 버전

------------------------------------------------------------

# 4. FINAL PROJECT STRUCTURE

다음 구조를 최종 표준으로 사용한다 (표준 경로는 "0.1 ASSET PATH MAPPING" 참조).

```text
Content-OS/
│
├── CLAUDE.md
├── README.md
├── 00_PROJECT_CONSTITUTION.md
│
├── 01_SYSTEM/
│   ├── SYSTEM_PROMPT.md
│   ├── CORE_RULES.md
│   ├── QUALITY_GATE.md
│   ├── ERROR_POLICY.md
│   ├── COMMAND_ROUTER.md
│   ├── STATE_MACHINE.md
│   ├── SECURITY_POLICY.md
│   └── HANDOFF_POLICY.md
│
├── 02_WORKFLOW/
│   ├── WF-01_REFERENCE_ANALYSIS.md
│   ├── WF-02_KNOWLEDGE_ENGINEERING.md
│   ├── WF-03_KEYWORD_INTELLIGENCE.md
│   ├── WF-04_CONTENT_ARCHITECTURE.md
│   ├── WF-05_CONTENT_GENERATION.md
│   ├── WF-06_QUALITY_REVIEW.md
│   ├── WF-07_EXPORT_AND_PUBLISHING.md
│   ├── WF-08_PROJECT_LEARNING.md
│   ├── WF-09_MASTER_ORCHESTRATION.md
│   ├── WF-10_SYSTEM_VALIDATION.md
│   ├── WF-11_PRODUCTION_OPERATIONS.md
│   ├── WF-12_PERFORMANCE_AND_APPROVAL_INTELLIGENCE.md
│   ├── WF-13_ADSENSE_AND_SITE_REMEDIATION.md
│   ├── WF-14_CONTENT_OPTIMIZATION.md
│   ├── WF-15_GOVERNANCE_AND_CHANGE_CONTROL.md
│   └── WF-16_FINAL_COMMAND_CENTER.md
│
├── 03_REFERENCE/
├── 04_INPUT/
├── 05_OUTPUT/
├── 06_MEMORY/
├── 07_TEMPLATE/
├── 08_LOG/ (WF-01~WF-16)
├── 09_ARCHIVE/
├── 10_RUNTIME/
├── 11_REPORTS/
├── 12_TEST/
├── 13_OPERATIONS/
├── 14_PERFORMANCE/
├── 15_REMEDIATION/
├── 16_OPTIMIZATION/
└── 17_GOVERNANCE/
```

기존 파일은 덮어쓰지 않는다. 이미 존재하는 폴더/파일은 그대로 유지하고, 누락된 항목만 생성한다.

------------------------------------------------------------

# 5. FINAL REQUIRED OUTPUT

WF-16은 다음 파일을 생성하거나 갱신한다.

```text
CLAUDE.md
README.md

01_SYSTEM/SYSTEM_PROMPT.md
01_SYSTEM/CORE_RULES.md
01_SYSTEM/QUALITY_GATE.md
01_SYSTEM/ERROR_POLICY.md
01_SYSTEM/COMMAND_ROUTER.md
01_SYSTEM/STATE_MACHINE.md
01_SYSTEM/SECURITY_POLICY.md
01_SYSTEM/HANDOFF_POLICY.md

02_WORKFLOW/WF-16_FINAL_COMMAND_CENTER.md

10_RUNTIME/command_context.json
10_RUNTIME/dependency_graph.json
10_RUNTIME/workflow_state.json

11_REPORTS/FINAL_SYSTEM_REPORT.md
11_REPORTS/COMMAND_REFERENCE.md
11_REPORTS/PROJECT_HANDOVER.md
11_REPORTS/FINAL_PROJECT_STRUCTURE.md

06_MEMORY/final_integration_registry.json
06_MEMORY/command_history.json
06_MEMORY/system_capability_registry.json

08_LOG/WF-16/run_<timestamp>.json
08_LOG/WF-16/environment_validation.json
```

------------------------------------------------------------

# 6. FINAL CLAUDE.MD PURPOSE

최종 `CLAUDE.md`는 Claude Code가 프로젝트에 진입할 때 가장 먼저 읽는 중앙 지침 파일이다.

다음 내용을 포함해야 한다: 프로젝트 정체성 / 최종 목표 / 절대 규칙 / Workflow 목록 / Workflow 책임 / 실행 순서 / 명령 라우팅 / 상태 관리 / 파일 경로 / 품질 기준 / 보안 기준 / 게시 제한 / 애드센스 관련 제한 / 오류 처리 / 복구 정책 / Version 및 Governance 정책 / 사용자 보고 형식

------------------------------------------------------------

# 7. FINAL CLAUDE.MD STANDARD

다음 구조로 `CLAUDE.md`를 생성한다.

```markdown
# Content OS

## 1. Project Identity

이 프로젝트는 벤치마킹 사이트의 문장이나 콘텐츠를 복제하는 시스템이 아니다.

이 프로젝트는 검증된 사이트에서 추출한 구조적 Rule, Pattern, Template, Content DNA를 활용해 독창적이고 정확한 콘텐츠를 기획·작성·검수·배포·분석·개선하는 Content Operating System이다.

## 2. Primary Objective

- 사용자가 제공한 Keyword를 체계적으로 처리한다.
- Reference 사이트에서 구조적 원리를 추출한다.
- 독창적인 콘텐츠를 생성한다.
- 사실성과 출처를 검증한다.
- WordPress 게시 패키지 또는 Draft를 생성한다.
- 검색 및 애드센스 결과를 실제 데이터로 분석한다.
- 확인된 문제만 수정한다.
- 모든 변경을 Governance로 통제한다.

## 3. Absolute Rules

1. 사용자에게 이미 제공된 정보를 다시 묻지 않는다.
2. 다음 단계를 제안하지 않는다.
3. Reference 콘텐츠를 복제하지 않는다.
4. 확인되지 않은 사실을 만들지 않는다.
5. 가짜 경험, 후기, 전문가 의견을 만들지 않는다.
6. 애드센스 승인, 트래픽, 순위, 수익을 보장하지 않는다.
7. 검수되지 않은 콘텐츠를 배포하지 않는다.
8. 자동 Publish를 기본값으로 사용하지 않는다.
9. Secret과 인증정보를 출력하거나 저장하지 않는다.
10. 품질 및 보안 기준을 낮추지 않는다.
11. 변경은 Snapshot, Test, Rollback을 가져야 한다.
12. 핵심 변경은 WF-15 Governance를 거친다.

## 4. Workflow Map

- WF-01: Reference Analysis
- WF-02: Knowledge Engineering
- WF-03: Keyword Intelligence
- WF-04: Content Architecture
- WF-05: Content Generation
- WF-06: Quality Review
- WF-07: Export and Publishing
- WF-08: Project Learning
- WF-09: Master Orchestration
- WF-10: System Validation
- WF-11: Production Operations
- WF-12: Performance and Approval Intelligence
- WF-13: AdSense and Site Remediation
- WF-14: Content Optimization
- WF-15: Governance and Change Control
- WF-16: Final Command Center

## 5. Standard Execution Order

WF-01 → WF-02 → WF-03 → WF-04 → WF-05 → WF-06 → WF-07 → WF-08

WF-09 controls execution.

WF-10 validates the system.

WF-11 manages production.

WF-12 analyzes actual results.

WF-13 fixes confirmed problems.

WF-14 runs controlled optimization.

WF-15 governs project changes.

## 6. Default Behavior

When a user command is received:

1. Read Project Constitution.
2. Read CLAUDE.md.
3. Detect project state.
4. Load Command Router.
5. Determine execution mode.
6. Validate dependencies.
7. Build execution queue.
8. Execute only eligible workflows.
9. Validate output and handoff.
10. Save state and logs.
11. Report the result.

## 7. Default Publishing Safety

- Default mode: EXPORT_ONLY or WORDPRESS_DRAFT
- Auto Publish: disabled
- Auto Schedule: disabled
- Delete: disabled
- Redirect: manual review
- Noindex: manual review
- AdSense application: manual only
- AdSense reapplication: manual only

## 8. Quality Gate

No content may proceed to WF-07 unless:

- WF-06 score is at least 92
- Critical issues = 0
- Major issues = 0
- High-risk facts are verified
- Policy status is passed
- Source package is valid
- Markdown and HTML are consistent

## 9. Reporting

At completion report only:

- Run ID
- Command
- Execution mode
- Workflow states
- Processed items
- Created and updated files
- Quality results
- WordPress results
- Blocking issues
- Recovery requirements
- Final status
```

이 저장소에서는 위 표준 본문에 "0.1 ASSET PATH MAPPING"으로의 안내와 실제 명령 진입점(`01_SYSTEM/COMMAND_ROUTER.md`, `02_WORKFLOW/`)에 대한 경로 안내를 더해 루트 `CLAUDE.md`를 구성한다 (실제 생성된 파일은 저장소 루트 `CLAUDE.md` 참조).

------------------------------------------------------------

# 8. FINAL SYSTEM PROMPT

`01_SYSTEM/SYSTEM_PROMPT.md`는 다음 규칙을 가진다.

```text
당신은 Content OS의 실행 에이전트다.

당신은 사용자의 Keyword를 단순히 글로 바꾸는 Writer가 아니다.

당신은 Reference 분석, Knowledge 추출, Keyword 검증, Content Architecture, Content Generation, Quality Review, Publishing, Performance Analysis, Remediation, Optimization, Governance를 단계적으로 수행하는 운영 시스템이다.

항상 다음 순서를 지킨다.

1. Project Constitution
2. CLAUDE.md
3. Current Runtime State
4. Workflow Definition
5. Required Memory
6. Required Input
7. Required Output
8. Handoff
9. Logging
10. Final Report

다음을 수행하지 않는다.

- 사용자에게 이미 알려진 내용을 다시 묻기
- 벤치마킹 콘텐츠 복제
- 확인되지 않은 정보 생성
- 애드센스 승인 보장
- 수익 보장
- 검수 생략
- 자동 Publish
- Secret 출력
- 핵심 파일 무검증 변경

오류가 발생하면 숨기지 않는다.

전체를 완료할 수 없는 경우에도 완료된 범위, 차단 원인, 필요한 반환 Workflow를 정확히 기록한다.
```

## 8.1 CORE RULES STANDARD

`01_SYSTEM/CORE_RULES.md`의 내용 구조는 이 문서에서 별도 섹션으로 명시되지 않으므로, 섹션 3(ABSOLUTE OPERATING RULES)과 섹션 7의 "CLAUDE.md 표준 3. Absolute Rules"에서 이미 확정된 규칙을 그대로 옮겨 다음 구조로 생성한다.

```text
CORE RULES — Content OS

01. 사용자에게 이미 확인 가능한 정보를 다시 묻지 않는다. (3.1)
02. 하나의 전체 실행 명령으로 상태 확인부터 최종 보고까지 자동 처리한다. (3.2)
03. 각 문제는 담당 Workflow에만 전달한다 — 다른 Workflow가 대신 처리하지 않는다. (3.3)
04. 애드센스 승인, 검색 순위, 트래픽, 광고 수익을 보장하지 않는다. (3.4)
05. 벤치마킹 사이트의 문장·문단·목차·사례·표현·디자인·브랜드·이미지를 복제하지 않는다 — Rule/Pattern/Template/Content DNA로만 추상화하여 활용한다. (3.5)
06. 기본 게시 범위는 EXPORT_ONLY 또는 WORDPRESS_DRAFT다. Publish/Schedule/Delete/Noindex/Redirect/Merge/AdSense 신청·재신청은 명시적 권한과 검증 없이 수행하지 않는다. (3.6)
07. Secret과 인증정보는 어떤 산출물에도 기록하지 않는다 — 환경변수 이름과 존재 여부만 기록한다. (3.7)
08. Project Constitution, System Prompt, Core Rule, Content DNA, Rule/Template Library, Decision Tree, Workflow, Quality Gate, Security/Publication Policy, Registry Schema, 자동화 권한의 변경은 WF-15 Governance를 거친다. (3.8)
09. 품질 검수, 출처 검증, WF-06 통과 기준을 처리량이나 속도보다 우선한다. (3.9)
10. 모든 변경은 어떤 Workflow가 생성했는지, Input/Output/Version/Hash/상태/Handoff/오류/수정 이력/Archive 위치/Rollback 위치/실행 시간/프로젝트 버전을 추적 가능하게 기록한다. (3.10)
```

------------------------------------------------------------

# 9. COMMAND ROUTER

`01_SYSTEM/COMMAND_ROUTER.md`를 생성한다.

Command Router는 사용자의 자연어 명령을 실행 모드와 Workflow로 변환한다.

## 9.1 PROJECT COMMANDS

**프로젝트 초기화**

```text
Content OS 초기화
프로젝트 초기화
Content OS 프로젝트 생성
```

라우팅:

```yaml
command:
  mode: INITIALIZE
  workflows:
    - WF-16
    - WF-10
```

수행: 프로젝트 폴더 생성 / 기본 Config 생성 / Memory 및 Registry 초기화 / Workflow 파일 확인 / CLAUDE.md 생성 / Dry Run / Quick Validation

**전체 실행**

```text
Content OS 전체 실행
전체 프로세스 실행
모든 키워드 처리
```

라우팅:

```yaml
command:
  mode: FULL
  controller: WF-09
  workflows:
    - WF-01
    - WF-02
    - WF-03
    - WF-04
    - WF-05
    - WF-06
    - WF-07
    - WF-08
```

**이어서 실행**

```text
Content OS 이어서 실행
다음 단계 진행
계속 실행
```

라우팅:

```yaml
command:
  mode: CONTINUE
  controller: WF-09
```

**변경분 실행**

```text
변경된 것만 실행
Content OS 변경분 실행
```

라우팅:

```yaml
command:
  mode: INCREMENTAL
  controller: WF-09
```

## 9.2 KEYWORD COMMANDS

**키워드 전체 처리**

```text
Content OS 키워드 실행: KW-0001
키워드 처리: [키워드]
```

라우팅:

```yaml
command:
  mode: CONTENT_PIPELINE
  scope:
    keyword_id:
  workflows:
    - WF-03
    - WF-04
    - WF-05
    - WF-06
    - WF-07
```

**Brief 생성**

```text
키워드 Brief 생성: KW-0001
```

라우팅: `workflow: WF-03`

**Architecture 생성**

```text
콘텐츠 구조 생성: KW-0001
```

라우팅: `workflow: WF-04`

**콘텐츠 작성**

```text
콘텐츠 작성: KW-0001
```

라우팅: `workflow: WF-05`

**품질 검수**

```text
콘텐츠 검수: KW-0001
```

라우팅: `workflow: WF-06`

## 9.3 PUBLISHING COMMANDS

**Export 생성**

```text
Content OS 내보내기: KW-0001
```

라우팅:

```yaml
workflow: WF-07
mode: EXPORT_ONLY
```

**WordPress 초안 생성**

```text
WordPress 초안 생성: KW-0001
Content OS WordPress 초안 생성
```

라우팅:

```yaml
workflow: WF-07
mode: WORDPRESS_DRAFT
```

조건: WF-06 승인 / WordPress Config 유효 / 인증 환경변수 존재 / Category와 Author 해결 / 자동 Publish는 금지

**WordPress 동기화**

```text
WordPress 동기화
미동기화 초안 동기화
```

라우팅:

```yaml
workflow: WF-07
mode: SYNC_PENDING_DRAFTS
```

## 9.4 OPERATIONS COMMANDS

**운영 초기화**

```text
Content OS 운영 초기화
```

라우팅: `workflow: WF-11` / `mode: INITIALIZE`

**운영 시작**

```text
Content OS 운영 시작
```

라우팅: `workflow: WF-11` / `mode: START`

**다음 Batch**

```text
Content OS 다음 Batch
```

라우팅: `workflow: WF-11` / `mode: NEXT_BATCH`

**운영 일시 중단**

```text
Content OS 운영 일시 중단
```

라우팅: `workflow: WF-11` / `mode: PAUSE`

**운영 재개**

```text
Content OS 운영 재개
```

라우팅: `workflow: WF-11` / `mode: RESUME`

## 9.5 PERFORMANCE COMMANDS

**전체 성과 분석**

```text
Content OS 성과 분석
WF-12 전체 실행
```

라우팅: `workflow: WF-12` / `mode: FULL`

**색인 분석**

```text
색인 상태 분석
```

라우팅: `workflow: WF-12` / `mode: INDEXING`

**검색 성과 분석**

```text
검색 성과 분석
```

라우팅: `workflow: WF-12` / `mode: SEARCH_PERFORMANCE`

**애드센스 분석**

```text
애드센스 상태 분석
애드센스 승인 결과 확인
```

라우팅: `workflow: WF-12` / `mode: ADSENSE`

## 9.6 REMEDIATION COMMANDS

**애드센스 거절 대응**

```text
애드센스 거절 대응
승인 거절 수정
```

라우팅: `workflow: WF-13` / `mode: ADSENSE_REJECTION`

**색인 문제 수정**

```text
색인 문제 수정
```

라우팅: `workflow: WF-13` / `mode: INDEXING_REMEDIATION`

**저가치 콘텐츠 대응**

```text
저가치 콘텐츠 수정
```

라우팅: `workflow: WF-13` / `mode: LOW_VALUE_CONTENT`

**재신청 준비 상태**

```text
애드센스 재신청 준비 상태
```

라우팅: `workflow: WF-13` / `mode: REAPPLICATION_READINESS`

애드센스 신청을 실제 제출하지 않는다.

## 9.7 OPTIMIZATION COMMANDS

**후보 탐지**

```text
콘텐츠 최적화 후보 탐지
```

라우팅: `workflow: WF-14` / `mode: DETECT`

**특정 콘텐츠 최적화**

```text
콘텐츠 최적화: KW-0001
```

라우팅: `workflow: WF-14` / `mode: CONTENT`

**CTR 최적화**

```text
CTR 최적화
```

라우팅: `workflow: WF-14` / `mode: CTR`

**최신성 갱신**

```text
오래된 콘텐츠 갱신
```

라우팅: `workflow: WF-14` / `mode: FRESHNESS`

## 9.8 GOVERNANCE COMMANDS

**Proposal 수집**

```text
변경 제안 수집
```

라우팅: `workflow: WF-15` / `mode: COLLECT`

**Proposal 검토**

```text
변경 제안 검토: CP-0001
```

라우팅: `workflow: WF-15` / `mode: REVIEW_PROPOSAL`

**Sandbox 테스트**

```text
변경안 Sandbox 테스트: CHG-0001
```

라우팅: `workflow: WF-15` / `mode: SANDBOX_TEST`

**Release 상태**

```text
프로젝트 버전 상태
Release 상태
```

라우팅: `workflow: WF-15` / `mode: VERSION_STATUS`

**Rollback**

```text
Release Rollback: REL-0001
```

라우팅: `workflow: WF-15` / `mode: ROLLBACK`

## 9.9 TEST COMMANDS

**빠른 테스트**

```text
Content OS 빠른 테스트
```

라우팅: `workflow: WF-10` / `mode: QUICK`

**전체 테스트**

```text
Content OS 전체 테스트
```

라우팅: `workflow: WF-10` / `mode: FULL`

**End-to-End 테스트**

```text
Content OS E2E 테스트
```

라우팅: `workflow: WF-10` / `mode: END_TO_END`

**보안 테스트**

```text
Content OS 보안 테스트
```

라우팅: `workflow: WF-10` / `mode: SECURITY`

**WordPress 안전 테스트**

```text
WordPress 안전 테스트
```

라우팅: `workflow: WF-10` / `mode: WORDPRESS_SAFETY`

## 9.10 STATUS COMMANDS

**전체 상태**

```text
Content OS 상태
프로젝트 상태
```

라우팅:

```yaml
mode: STATUS_ONLY
sources:
  - WF-09
  - WF-10
  - WF-11
  - WF-12
  - WF-13
  - WF-14
  - WF-15
```

**차단 목록**

```text
Content OS 차단 목록
```

라우팅: `mode: BLOCKED_ITEMS`

**수동 검토 목록**

```text
Content OS 수동 검토 목록
```

라우팅: `mode: MANUAL_REVIEW_ITEMS`

**운영 상태**

```text
Content OS 운영 상태
```

라우팅: `workflow: WF-11` / `mode: STATUS`

## 9.11 RECOVERY COMMANDS

**전체 복구**

```text
Content OS 복구
```

라우팅: `workflow: WF-09` / `mode: RECOVERY`

**운영 복구**

```text
Content OS 운영 복구
```

라우팅: `workflow: WF-11` / `mode: RECOVERY`

**WordPress 동기화 재시도**

```text
WordPress 동기화 재시도
```

라우팅: `workflow: WF-07` / `mode: RETRY_SYNC`

**실패 테스트 재실행**

```text
실패 테스트 재실행
```

라우팅: `workflow: WF-10` / `mode: RETRY_FAILED`

------------------------------------------------------------

# 10. COMMAND CONTEXT SCHEMA

모든 명령을 다음 구조로 변환한다.

```yaml
schema_version: "1.0"

command_context:
  command_id:
  received_at:
  raw_command:
  normalized_command:
  command_category:
  execution_mode:

  scope:
    project:
    site_ids: []
    keyword_ids: []
    content_ids: []
    publication_ids: []
    case_ids: []
    experiment_ids: []
    proposal_ids: []
    changeset_ids: []
    release_ids: []

  routing:
    controller:
    workflows: []
    start_workflow:
    end_workflow:

  permissions:
    allow_file_changes:
    allow_wordpress_draft:
    allow_schedule:
    allow_publish:
    allow_delete:
    allow_adsense_submission:

  safety:
    require_quality_gate:
    require_test:
    require_snapshot:
    require_governance:
    require_manual_review:

  state:
    project_version:
    current_run:
    active_batch:
    active_incident:
    active_remediation:
    active_optimization:
    active_release:

  status:
  blocking_issues: []
```

저장 위치: `10_RUNTIME/command_context.json`

------------------------------------------------------------

# 11. STATE MACHINE

`01_SYSTEM/STATE_MACHINE.md`는 시스템 상태 전환을 정의한다.

## 11.1 Project 상태

```text
NOT_INITIALIZED
INITIALIZING
READY
RUNNING
PARTIALLY_COMPLETED
COMPLETED
DEGRADED
PAUSED
BLOCKED
FAILED
MAINTENANCE
CHANGE_FREEZE
```

## 11.2 Content 상태

```text
KEYWORD_REGISTERED
BRIEF_READY
ARCHITECTURE_READY
DRAFT_READY
REVIEW_APPROVED
EXPORT_READY
WORDPRESS_DRAFT_CREATED
PUBLISHED
PERFORMANCE_OBSERVING
REMEDIATION_ACTIVE
OPTIMIZATION_ACTIVE
MANUAL_REVIEW_REQUIRED
BLOCKED
ARCHIVED
```

## 11.3 상태 전환 원칙

```text
KEYWORD_REGISTERED
→ BRIEF_READY
→ ARCHITECTURE_READY
→ DRAFT_READY
→ REVIEW_APPROVED
→ EXPORT_READY
→ WORDPRESS_DRAFT_CREATED
→ PUBLISHED
→ PERFORMANCE_OBSERVING
```

오류 발생 시:

```text
DRAFT_READY → WF05_REVISION_REQUIRED
REVIEW_APPROVED → EXPORT_READY
POLICY_BLOCKED → BLOCKED
TECHNICAL_ISSUE → REMEDIATION_ACTIVE
PERFORMANCE_CANDIDATE → OPTIMIZATION_ACTIVE
```

------------------------------------------------------------

# 12. HANDOFF POLICY

`01_SYSTEM/HANDOFF_POLICY.md`를 생성한다.

모든 Workflow Handoff는 다음 구조를 가져야 한다.

```yaml
handoff:
  source_workflow:
  next_workflow:
  status:
  ready:
  input_paths: []
  output_paths: []
  blocking_issues: []
  warnings: []
  version:
  created_at:
```

다음을 금지한다: `ready: false`인데 다음 Workflow 실행 / Blocking Issue 무시 / 존재하지 않는 Output 경로 전달 / 다른 Content ID 전달 / Version 불일치 / 상태 누락 / Handoff 파일 없이 강제 진행

## 12.1 SECURITY POLICY STANDARD

`01_SYSTEM/SECURITY_POLICY.md`의 내용 구조는 이 문서에서 별도 섹션으로 명시되지 않으므로, 섹션 3.7(Secret을 출력하거나 저장하지 않는다), 섹션 19.4(안전 검증의 Secret 없음 항목), 섹션 28(절대 금지의 Secret·인증정보 항목)에서 이미 확정된 내용과, WF-11/WF-12/WF-13/WF-14/WF-15가 각자 채택한 Security Policy(환경변수 이름만 기록, Credential 미저장, Delete API 미호출 등)를 하나로 묶어 다음 구조로 생성한다.

```text
SECURITY POLICY — Content OS

금지 항목 (어떤 산출물에도 기록하지 않는다):
- WordPress Password / Application Password
- API Token / Authorization Header
- Cookie / Session Token
- Database Password / Private Key
- AdSense Credential
- Search Console Credential
- Analytics Credential

허용 항목:
- 환경변수 이름 (예: WP_APPLICATION_PASSWORD)
- 환경변수 존재 여부 (true/false)

원칙:
- Secret은 코드·리포트·로그·Snapshot·Archive 어디에도 값 자체를 남기지 않는다.
- 자동 Publish, 자동 Schedule, 자동 Delete, 자동 AdSense 신청/재신청은 기본 비활성이며 명시적 권한과 검증 없이 활성화하지 않는다.
- WordPress Delete API는 어떤 Workflow에서도 호출하지 않는다.
- 운영 데이터와 테스트 데이터(12_TEST/)는 물리적으로 분리한다.
- 모든 신규 디렉터리는 커밋 전 Secret 노출 여부를 검사한다.
- Project Constitution, Security Policy 자체의 완화는 WF-15 Governance의 수동 승인 없이 적용하지 않는다.
```

------------------------------------------------------------

# 13. QUALITY GATE

`01_SYSTEM/QUALITY_GATE.md`를 최종 통합한다.

**콘텐츠 게시 Gate**

```yaml
quality_gate:
  minimum_score: 92
  critical_issues: 0
  major_issues: 0
  factuality_passed: true
  source_quality_passed: true
  originality_passed: true
  policy_passed: true
  html_valid: true
  architecture_compliant: true
```

**시스템 Release Gate**

```yaml
release_gate:
  proposal_approved: true
  snapshot_created: true
  rollback_valid: true
  wf10_passed: true
  security_passed: true
  regression_passed: true
  rollout_passed: true
```

------------------------------------------------------------

# 14. ERROR POLICY

`01_SYSTEM/ERROR_POLICY.md`는 다음 오류 분류를 사용한다.

```text
INFO
WARNING
MODERATE
MAJOR
CRITICAL
```

오류 유형:

```text
INPUT
CONFIG
FILESYSTEM
SCHEMA
DEPENDENCY
HANDOFF
CONTENT
FACTUALITY
SOURCE
POLICY
SECURITY
WORDPRESS
PERFORMANCE
REMEDIATION
OPTIMIZATION
GOVERNANCE
RUNTIME
LOCK
REGISTRY
```

오류 구조:

```yaml
error:
  error_id:
  run_id:
  workflow_id:
  content_id:
  category:
  severity:
  stage:
  description:
  root_cause:
  affected_items: []
  retryable:
  rollback_required:
  recovery_workflow:
  recovery_action:
  status:
```

------------------------------------------------------------

# 15. DEFAULT CONFIG GENERATION

누락된 설정은 안전 기본값으로 생성한다.

**project_config.yaml**

```yaml
schema_version: "1.0"

project:
  name: Content OS
  language: ko-KR
  timezone: Asia/Seoul
  environment: development

workflow:
  automatic_continue: true
  stop_on_critical: true
  continue_on_warning: true

quality:
  minimum_score: 92
  critical_allowed: 0
  major_allowed: 0
```

**site_config.yaml**

```yaml
schema_version: "1.0"

site:
  name:
  base_url:
  language: ko-KR
  timezone: Asia/Seoul

content:
  default_author:
  body_h1: false

sources:
  display_mode: SOURCE_SECTION

seo:
  canonical_mode: PUBLIC_URL_ONLY
```

**publication_config.yaml**

```yaml
schema_version: "1.0"

publication:
  default_mode: EXPORT_ONLY
  allow_auto_publish: false
  allow_scheduling: false

wordpress:
  enabled: false
  create_draft: true
  allow_update: true
  allow_publish: false
  allow_delete: false

media:
  upload_enabled: false
```

**wordpress_config.yaml**

```yaml
schema_version: "1.0"

wordpress:
  enabled: false

site:
  base_url:
  api_base_url:

authentication:
  method: APPLICATION_PASSWORD
  username_env: WP_USERNAME
  password_env: WP_APPLICATION_PASSWORD

safety:
  allow_create: true
  allow_update: true
  allow_publish: false
  allow_delete: false
```

실제 Secret 값을 기록하지 않는다. 이 저장소에는 `04_INPUT/publication_config.yaml`, `wordpress_config.yaml`이 이미 존재하므로 WF-16은 이를 덮어쓰지 않고 그대로 유지하며, `project_config.yaml`, `site_config.yaml`은 아직 생성되지 않았으므로 필요 시 위 기본값으로 신규 생성한다.

------------------------------------------------------------

# 16. INITIALIZATION WORKFLOW

`Content OS 초기화` 명령 시 다음 순서로 수행한다.

```text
STEP 01  프로젝트 루트 확인
STEP 02  Project Constitution 확인
STEP 03  폴더 구조 생성
STEP 04  Workflow 파일 확인
STEP 05  CLAUDE.md 생성
STEP 06  System 파일 생성
STEP 07  기본 Config 생성
STEP 08  빈 Registry 생성
STEP 09  Runtime 파일 생성
STEP 10  Dependency Graph 생성
STEP 11  Command Router 생성
STEP 12  상태 Machine 생성
STEP 13  Quick Test 실행
STEP 14  초기화 보고서 생성
```

기존 파일은 덮어쓰지 않는다.

동일 이름 파일이 존재하면 내용을 비교하고, 변경이 필요한 경우 Governance Proposal을 생성한다.

------------------------------------------------------------

# 17. FINAL DEPENDENCY GRAPH

```yaml
dependencies:
  WF-01: []

  WF-02:
    - WF-01

  WF-03:
    - WF-02

  WF-04:
    - WF-03

  WF-05:
    - WF-04

  WF-06:
    - WF-05

  WF-07:
    - WF-06

  WF-08:
    - WF-01
    - WF-02
    - WF-03
    - WF-04
    - WF-05
    - WF-06
    - WF-07

  WF-09:
    - WF-01
    - WF-02
    - WF-03
    - WF-04
    - WF-05
    - WF-06
    - WF-07
    - WF-08

  WF-10:
    - WF-01
    - WF-02
    - WF-03
    - WF-04
    - WF-05
    - WF-06
    - WF-07
    - WF-08
    - WF-09

  WF-11:
    - WF-09
    - WF-10

  WF-12:
    - WF-07
    - WF-11

  WF-13:
    - WF-12

  WF-14:
    - WF-12
    - WF-13

  WF-15:
    - WF-08
    - WF-10
    - WF-11
    - WF-12
    - WF-13
    - WF-14

  WF-16:
    - WF-01
    - WF-02
    - WF-03
    - WF-04
    - WF-05
    - WF-06
    - WF-07
    - WF-08
    - WF-09
    - WF-10
    - WF-11
    - WF-12
    - WF-13
    - WF-14
    - WF-15
```

------------------------------------------------------------

# 18. PROJECT CAPABILITY REGISTRY

다음 파일을 생성한다: `06_MEMORY/system_capability_registry.json`

구조:

```yaml
schema_version: "1.0"

capabilities:
  reference_analysis:
    workflow: WF-01
    enabled:
    status:

  knowledge_engineering:
    workflow: WF-02
    enabled:
    status:

  keyword_intelligence:
    workflow: WF-03
    enabled:
    status:

  content_architecture:
    workflow: WF-04
    enabled:
    status:

  content_generation:
    workflow: WF-05
    enabled:
    status:

  quality_review:
    workflow: WF-06
    enabled:
    status:

  export:
    workflow: WF-07
    enabled:
    status:

  wordpress_draft:
    workflow: WF-07
    enabled:
    status:

  project_learning:
    workflow: WF-08
    enabled:
    status:

  orchestration:
    workflow: WF-09
    enabled:
    status:

  system_validation:
    workflow: WF-10
    enabled:
    status:

  production_operations:
    workflow: WF-11
    enabled:
    status:

  performance_analysis:
    workflow: WF-12
    enabled:
    status:

  adsense_tracking:
    workflow: WF-12
    enabled:
    status:

  remediation:
    workflow: WF-13
    enabled:
    status:

  optimization:
    workflow: WF-14
    enabled:
    status:

  governance:
    workflow: WF-15
    enabled:
    status:

  auto_publish:
    workflow: WF-07
    enabled: false
    status: DISABLED_BY_DEFAULT

  adsense_auto_submission:
    enabled: false
    status: PROHIBITED
```

------------------------------------------------------------

# 19. FINAL SYSTEM VALIDATION

WF-16 완료 전 다음 검증을 수행한다.

## 19.1 구조 검증

필수 폴더 존재 / Workflow 16개 존재 / CLAUDE.md 존재 / Project Constitution 존재 / System 파일 존재 / Config 파일 존재 / Runtime 파일 존재 / Registry 파일 존재

## 19.2 Workflow 검증

각 Workflow Role 존재 / Required Input 존재 / Required Output 존재 / Success Condition 존재 / Handoff 존재 / Command Behavior 존재

## 19.3 연결 검증

WF-01 → WF-02 / WF-02 → WF-03 / WF-03 → WF-04 / WF-04 → WF-05 / WF-05 → WF-06 / WF-06 → WF-07 / WF-07 → WF-08 / WF-09 Orchestration / WF-10 Acceptance / WF-11 Operations / WF-12 Performance / WF-13 Remediation / WF-14 Optimization / WF-15 Governance

## 19.4 안전 검증

Auto Publish 비활성 / Delete 비활성 / Secret 없음 / 품질 Gate 92 유지 / WF-06 필수 / WF-10 필수 / Snapshot 필수 / Rollback 필수 / AdSense 자동 신청 비활성

## 19.5 Command Router 검증

모든 최종 명령이 적절한 Workflow로 라우팅되는지 확인한다.

------------------------------------------------------------

# 20. FINAL SYSTEM REPORT

다음 파일을 생성한다: `11_REPORTS/FINAL_SYSTEM_REPORT.md`

형식:

```markdown
# Content OS Final System Report

## 프로젝트 정보

- Project Name:
- Project Version:
- Project Root:
- Language:
- Timezone:
- Environment:

## 통합 상태

- CLAUDE.md:
- Project Constitution:
- System Files:
- Workflow Files:
- Config:
- Memory:
- Runtime:
- Test:
- Operations:
- Performance:
- Remediation:
- Optimization:
- Governance:

## Workflow 상태

### WF-01
### WF-02
### WF-03
### WF-04
### WF-05
### WF-06
### WF-07
### WF-08
### WF-09
### WF-10
### WF-11
### WF-12
### WF-13
### WF-14
### WF-15
### WF-16

## 지원 기능

- Reference 분석:
- Keyword 처리:
- 콘텐츠 생성:
- 품질 검수:
- WordPress Export:
- WordPress Draft:
- 전체 자동 실행:
- 시스템 테스트:
- Production 운영:
- 성과 분석:
- AdSense 상태 분석:
- 거절 대응:
- 콘텐츠 최적화:
- Governance:
- Rollback:

## 기본 안전 설정

- Auto Publish:
- Delete:
- AdSense Submission:
- Quality Minimum:
- Critical Allowed:
- Major Allowed:
- Secret Check:

## Command Router

## 테스트 결과

## 차단된 기능

## 수동 설정 필요 항목

## 생성·수정 파일

## 최종 시스템 상태
```

------------------------------------------------------------

# 21. PROJECT HANDOVER DOCUMENT

다음 파일을 생성한다: `11_REPORTS/PROJECT_HANDOVER.md`

포함 내용:

```markdown
# Content OS Project Handover

## 1. 프로젝트 목적
## 2. 전체 Workflow
## 3. 프로젝트 실행 방법
## 4. 최초 설정 방법
## 5. Keyword 입력 방법
## 6. Reference 입력 방법
## 7. 전체 실행 명령
## 8. 특정 Keyword 실행 방법
## 9. WordPress 설정 방법
## 10. WordPress 초안 생성 방법
## 11. 품질 검수 기준
## 12. 애드센스 결과 등록 방법
## 13. 승인 거절 대응 방법
## 14. 성과 데이터 입력 방법
## 15. 콘텐츠 최적화 방법
## 16. 오류 복구 방법
## 17. 테스트 방법
## 18. Governance 및 Version 관리
## 19. 보안 주의사항
## 20. 금지된 작업
## 21. 주요 파일 위치
## 22. 운영 명령 모음
```

------------------------------------------------------------

# 22. COMMAND REFERENCE

다음 파일을 생성한다: `11_REPORTS/COMMAND_REFERENCE.md`

최종 명령을 다음 범주로 정리한다: `PROJECT` / `CONTENT` / `PUBLISHING` / `OPERATIONS` / `PERFORMANCE` / `ADSENSE` / `REMEDIATION` / `OPTIMIZATION` / `TEST` / `GOVERNANCE` / `STATUS` / `RECOVERY`

예:

```markdown
# Content OS Command Reference

## Project
- Content OS 초기화
- Content OS 전체 실행
- Content OS 이어서 실행
- Content OS 변경분 실행

## Content
- Content OS 키워드 실행: KW-0001
- 콘텐츠 작성: KW-0001
- 콘텐츠 검수: KW-0001

## Publishing
- Content OS 내보내기: KW-0001
- WordPress 초안 생성: KW-0001
- WordPress 동기화

## Operations
- Content OS 운영 초기화
- Content OS 운영 시작
- Content OS 다음 Batch
- Content OS 운영 일시 중단
- Content OS 운영 재개

## Performance
- Content OS 성과 분석
- 색인 상태 분석
- 검색 성과 분석

## AdSense
- 애드센스 상태 분석
- 애드센스 거절 대응
- 애드센스 재신청 준비 상태

## Optimization
- 콘텐츠 최적화 후보 탐지
- 콘텐츠 최적화: KW-0001
- CTR 최적화
- 오래된 콘텐츠 갱신

## Test
- Content OS 빠른 테스트
- Content OS 전체 테스트
- Content OS E2E 테스트
- Content OS 보안 테스트

## Governance
- 변경 제안 수집
- 변경 제안 검토: CP-0001
- 프로젝트 버전 상태
- Release Rollback: REL-0001

## Status
- Content OS 상태
- Content OS 운영 상태
- Content OS 차단 목록
- Content OS 수동 검토 목록

## Recovery
- Content OS 복구
- Content OS 운영 복구
- WordPress 동기화 재시도
- 실패 테스트 재실행
```

------------------------------------------------------------

# 23. IDEMPOTENCY

WF-16을 동일 프로젝트 상태에서 다시 실행해도 다음을 중복 생성하지 않는다: CLAUDE.md / System 파일 / Workflow 파일 / Registry Item / Runtime State / Command 정의 / Capability / Final Report Entry

비교 항목: Project Version / Workflow File Hash / System File Hash / CLAUDE.md Hash / Config Hash / Dependency Graph Hash / Command Router Hash / Capability Registry Hash

변경이 없으면 다음 상태를 사용한다: `UNCHANGED`

기존 파일과 새 표준이 다르면 직접 덮어쓰지 않는다. 다음 중 하나로 처리한다: `PATCH_SAFE` | `GOVERNANCE_PROPOSAL_REQUIRED` | `MANUAL_REVIEW_REQUIRED`

------------------------------------------------------------

# 24. VERSION CONTROL

WF-16 최초 통합 버전은 다음과 같이 기록한다.

```yaml
project_version:
  version: "1.0.0"
  status: INITIAL_INTEGRATED_RELEASE
  workflows:
    WF-01: "1.0"
    WF-02: "1.0"
    WF-03: "1.0"
    WF-04: "1.0"
    WF-05: "1.0"
    WF-06: "1.0"
    WF-07: "1.0"
    WF-08: "1.0"
    WF-09: "1.0"
    WF-10: "1.0"
    WF-11: "1.0"
    WF-12: "1.0"
    WF-13: "1.0"
    WF-14: "1.0"
    WF-15: "1.0"
    WF-16: "1.0"
```

저장 위치: `06_MEMORY/project_versions.json` (실제 경로: `06_MEMORY/WORKFLOW_LIBRARY/project_versions.json`)

------------------------------------------------------------

# 25. FINAL COMMAND CENTER REGISTRY

다음 파일을 생성한다: `06_MEMORY/final_integration_registry.json`

구조:

```yaml
schema_version: "1.0"

integration:
  integration_id:
  project_version:
  integrated_at:
  status:

  files:
    claude_md:
    constitution:
    system_files: []
    workflow_files: []
    config_files: []
    registry_files: []
    runtime_files: []
    report_files: []

  validation:
    project_structure:
    workflow_integrity:
    command_router:
    dependency_graph:
    quality_gate:
    security:
    publishing_safety:
    governance:
    final_test:

  capabilities:
    available: []
    restricted: []
    disabled: []

  blocking_issues: []
  warnings: []
```

------------------------------------------------------------

# 26. FINAL WORKFLOW EXECUTION

WF-16은 다음 순서로 실행한다.

```text
STEP 01  프로젝트 루트 탐색
STEP 02  Project Constitution 검증
STEP 03  WF-01~WF-15 파일 검증
STEP 04  최종 프로젝트 구조 생성
STEP 05  CLAUDE.md 생성
STEP 06  System Prompt 통합
STEP 07  Core Rules 통합
STEP 08  Quality Gate 통합
STEP 09  Error Policy 통합
STEP 10  Security Policy 통합
STEP 11  Handoff Policy 통합
STEP 12  State Machine 생성
STEP 13  Command Router 생성
STEP 14  기본 Config 생성
STEP 15  Registry 및 Runtime 초기화
STEP 16  Dependency Graph 생성
STEP 17  Capability Registry 생성
STEP 18  Project Version 생성
STEP 19  Static 검증
STEP 20  Workflow Contract 검증
STEP 21  Command Routing 검증
STEP 22  Security 검증
STEP 23  Publishing Safety 검증
STEP 24  WF-10 Quick Test
STEP 25  Final Integration Registry 생성
STEP 26  Command Reference 생성
STEP 27  Project Handover 생성
STEP 28  Final System Report 생성
```

------------------------------------------------------------

# 27. FINAL REPORTING STANDARD

WF-16 완료 후 다음 정보만 보고한다.

```text
Integration ID
Project Version
Project Root
CLAUDE.md 상태
Project Constitution 상태
System 파일 수
Workflow 파일 수
Config 상태
Memory 및 Registry 상태
Runtime 상태
Dependency Graph 상태
Command Router 상태
Quality Gate 상태
Security 상태
Publishing Safety 상태
WF-10 Quick Test 결과
사용 가능한 기능
비활성화된 기능
수동 설정 필요 항목
차단 항목
경고
생성 파일
수정 파일
Archive 파일
최종 Content OS 상태
```

불필요한 기능 제안이나 다음 단계 제안을 하지 않는다.

------------------------------------------------------------

# 28. ABSOLUTE PROHIBITIONS

다음을 절대 수행하지 않는다.

- Project Constitution 임의 변경
- Workflow 정의 임의 축약
- Workflow 순서 무시
- CLAUDE.md에 Secret 기록
- WordPress 비밀번호 기록
- 자동 Publish 기본 활성화
- Delete 권한 활성화
- 애드센스 자동 신청 활성화
- 애드센스 자동 재신청 활성화
- 품질 점수 하향
- WF-06 생략
- WF-10 생략
- Governance 우회
- Reference 콘텐츠 복제 허용
- 가짜 경험 허용
- 미검증 사실 허용
- 승인 또는 수익 보장
- 운영 파일 무단 덮어쓰기
- Registry 초기화로 기존 데이터 삭제
- 기존 Project Version 삭제
- Release History 삭제
- Rollback History 삭제
- 사용자의 기존 설정 무시
- 이미 제공된 정보 재질문
- 사용자에게 추가 선택 요구
- 사용자에게 다음 단계 제안

------------------------------------------------------------

# 29. SUCCESS CONDITION

WF-16은 다음 조건을 모두 충족해야 완료된다.

1. Project Constitution을 확인했다.
2. WF-01부터 WF-15까지의 정의 파일을 검증했다.
3. 최종 프로젝트 폴더 구조를 완성했다.
4. `CLAUDE.md`를 생성했다.
5. System Prompt를 통합했다.
6. Core Rules를 통합했다.
7. Quality Gate를 통합했다.
8. Error Policy를 통합했다.
9. Security Policy를 통합했다.
10. Handoff Policy를 생성했다.
11. State Machine을 생성했다.
12. Command Router를 생성했다.
13. 사용자 명령을 Workflow로 연결했다.
14. 기본 안전 Config를 생성했다.
15. Registry와 Runtime 구조를 생성했다.
16. WF-01부터 WF-16까지의 Dependency Graph를 생성했다.
17. System Capability Registry를 생성했다.
18. Project Version `1.0.0`을 생성했다.
19. Static 구조 검증을 통과했다.
20. Workflow Contract 검증을 통과했다.
21. Command Routing 검증을 통과했다.
22. Quality Gate가 92점으로 유지됐다.
23. Secret이 어떤 파일에도 포함되지 않았다.
24. Auto Publish가 기본 비활성 상태다.
25. Delete가 비활성 상태다.
26. AdSense 자동 신청이 비활성 상태다.
27. WF-10 Quick Test를 실행했다.
28. Final Integration Registry를 생성했다.
29. Command Reference를 생성했다.
30. Project Handover 문서를 생성했다.
31. Final System Report를 생성했다.
32. 기존 프로젝트 파일을 무단 삭제하거나 덮어쓰지 않았다.
33. 사용자가 하나의 명령 체계로 Content OS 전체를 사용할 수 있다.

------------------------------------------------------------

# 30. FINAL EXECUTION INSTRUCTION

지금부터 다음 순서로 최종 통합을 수행한다.

1. 현재 디렉터리에서 Content OS 프로젝트 루트를 탐색한다.
2. `00_PROJECT_CONSTITUTION.md`를 읽고 검증한다.
3. `WF-01`부터 `WF-15`까지의 Workflow 정의 파일을 모두 검사한다.
4. 누락된 최종 프로젝트 폴더를 생성한다.
5. 기존 프로젝트 파일은 삭제하거나 무단 덮어쓰지 않는다.
6. 최종 `CLAUDE.md`를 생성한다.
7. `SYSTEM_PROMPT.md`를 통합 생성한다.
8. `CORE_RULES.md`를 통합 생성한다.
9. `QUALITY_GATE.md`를 통합 생성한다.
10. `ERROR_POLICY.md`를 통합 생성한다.
11. `SECURITY_POLICY.md`를 생성한다.
12. `HANDOFF_POLICY.md`를 생성한다.
13. `STATE_MACHINE.md`를 생성한다.
14. `COMMAND_ROUTER.md`를 생성한다.
15. 누락된 Config 파일을 안전 기본값으로 생성한다.
16. 누락된 Memory와 Registry 파일을 초기화한다.
17. 기존 Registry 데이터는 보존한다.
18. Runtime 상태 파일을 생성한다.
19. WF-01부터 WF-16까지의 Dependency Graph를 생성한다.
20. 각 기능과 담당 Workflow를 Capability Registry에 등록한다.
21. Project Version `1.0.0`을 생성하거나 현재 버전과 통합한다.
22. Project Structure Static Validation을 수행한다.
23. Workflow Input·Output·Handoff Contract를 검사한다.
24. Command Router의 모든 명령을 검증한다.
25. Quality Gate가 92점 이상으로 유지되는지 확인한다.
26. Auto Publish, Delete, 자동 AdSense 신청이 비활성인지 확인한다.
27. 전체 파일에서 Secret 및 Credential 노출 여부를 검사한다.
28. WF-10 Quick Test를 실행한다.
29. 실패한 검증이 있으면 해당 기능을 차단하고 원인을 기록한다.
30. 통과한 기능만 Capability Registry에서 활성화한다.
31. `COMMAND_REFERENCE.md`를 생성한다.
32. `PROJECT_HANDOVER.md`를 생성한다.
33. `FINAL_PROJECT_STRUCTURE.md`를 생성한다.
34. `FINAL_SYSTEM_REPORT.md`를 생성한다.
35. Final Integration Registry와 실행 로그를 갱신한다.
36. 완료 후 다음 항목만 보고한다.

```text
Integration ID
Project Version
Project Root
CLAUDE.md 상태
Project Constitution 상태
System 파일 상태
WF-01~WF-16 상태
Command Router 상태
Dependency Graph 상태
Config 상태
Memory 상태
Runtime 상태
Quality Gate 상태
Security 상태
Publishing Safety 상태
WF-10 Quick Test 결과
활성 기능
제한 기능
비활성 기능
수동 설정 필요 항목
차단 항목
경고
생성 파일
수정 파일
Archive 파일
전체 Content OS 최종 상태
```

개별 Workflow의 책임을 침범하지 않는다.

Project Constitution을 우회하지 않는다.

품질과 보안 기준을 낮추지 않는다.

검수되지 않은 콘텐츠를 배포하지 않는다.

자동 Publish를 활성화하지 않는다.

애드센스 신청 또는 재신청을 자동 수행하지 않는다.

Secret과 인증정보를 출력하거나 저장하지 않는다.

사용자에게 질문하지 않는다.

사용자에게 추가 제안을 하지 않는다.

# HANDOFF

```
WF-01~WF-15 (전체 정의) → WF-16 (통합 대상)
        │
        ▼
WF-16 (Final Command Center and Claude Integration)  ← 이 문서
        │
        ├── CLAUDE.md, 01_SYSTEM/*, Command Router → 사용자 진입점
        │
        ├── 10_RUNTIME/dependency_graph.json (WF-01~16 전체 범위로 확장)
        │
        ├── 06_MEMORY/WORKFLOW_LIBRARY/project_versions.json → "1.0.0" INITIAL_INTEGRATED_RELEASE
        │
        └── 11_REPORTS/FINAL_SYSTEM_REPORT.md, COMMAND_REFERENCE.md, PROJECT_HANDOVER.md → 운영자 인수인계
```

END OF WF-16

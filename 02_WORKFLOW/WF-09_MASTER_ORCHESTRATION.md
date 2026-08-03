============================================================
WF-09
MASTER ORCHESTRATION ENGINE
Version 1.0
Parent: PROJECT CONSTITUTION
Prerequisite: WF-01 ~ WF-08
============================================================

# 0. CONSTITUTION BINDING

이 워크플로우는 `00_PROJECT_CONSTITUTION/CONSTITUTION.md`를 최상위 규범으로 삼는다. 충돌 시 헌법이 우선한다.

이 워크플로우는 이 문서 하나만으로 독립적으로 실행 가능한 하나의 프로젝트다. 이 문서 밖의 대화 맥락에 의존하지 않는다.

WF-09는 개별 Workflow의 역할을 대체하지 않는다. WF-01~WF-08 각각의 판단(어떤 Rule을 적용할지, 어떤 콘텐츠를 승인할지 등)은 해당 워크플로우 문서가 소유하며, WF-09는 오직 "언제, 어떤 순서로, 실행 가능한지"만 결정한다.

# 0.1 ASSET PATH MAPPING

이 문서는 원래 아래와 같은 표준 프로젝트 레이아웃(`Content-OS/`)을 가정하고 작성되었다. 실제 이 저장소의 구조는 폴더 이름과 배치가 다르므로, WF-09는 아래 표대로 "의미가 같은 자산"을 우선 매핑한다 (STEP 01, 4장 참조).

| 이 문서가 가정하는 표준 경로 | 실제 프로젝트 경로 |
|---|---|
| `Content-OS/` (프로젝트 루트) | 저장소 루트 (변경 없음) |
| `CLAUDE.md` | `CLAUDE.md` (본 워크플로우가 시딩 — Claude Code 세션이 자동으로 읽는 진입점) |
| `00_PROJECT_CONSTITUTION.md` | `00_PROJECT_CONSTITUTION/CONSTITUTION.md` |
| `01_SYSTEM/SYSTEM_PROMPT.md` | 별도 파일 없음 — `CONSTITUTION.md`의 "Identity"/"Core Mission" 섹션이 이 역할을 한다 |
| `01_SYSTEM/CORE_RULES.md` | 별도 파일 없음 — `CONSTITUTION.md`의 "Operating Principles"/"Workflow Policy" 섹션이 이 역할을 한다 |
| `01_SYSTEM/QUALITY_GATE.md` | 별도 파일 없음 — `CONSTITUTION.md`의 "Quality Standard" 섹션 + 각 WF의 통과 기준(WF-04 92점, WF-05 90점, WF-06 92점)이 이 역할을 한다 |
| `01_SYSTEM/ERROR_POLICY.md` | 별도 파일 없음 — `CONSTITUTION.md`의 "Error Policy" 섹션이 이 역할을 한다 |
| `02_WORKFLOW/WF-01_REFERENCE_ANALYSIS.md` ~ `WF-08_PROJECT_LEARNING.md` | 동일 파일명, 동일 위치 (변경 없음) |
| `02_WORKFLOW/WF-09_MASTER_ORCHESTRATION.md` | 이 문서 자체 |
| `03_REFERENCE/benchmark_list.xlsx`, `reference_urls.csv`, `reference_sources/` | `04_INPUT/WF-01/reference_sites.md` (WF-01이 정의한 실제 입력 형식). `03_REFERENCE/`는 사람이 원본을 보관하는 용도로만 쓰이며 WF-09의 입력 탐지 대상이 아니다 |
| `04_INPUT/keywords.xlsx`, `.csv`, `.json` | `04_INPUT/keywords.csv` |
| `04_INPUT/project_config.yaml`, `site_config.yaml` | 존재하면 사용, 없으면 `MISSING_OPTIONAL`로 처리 (아직 이 프로젝트에 생성되지 않음) |
| `04_INPUT/publication_config.yaml` | `04_INPUT/publication_config.yaml` (WF-07이 이미 안전 기본값으로 시딩함) |
| `04_INPUT/wordpress_config.yaml` | `04_INPUT/wordpress_config.yaml` (WF-07이 이미 시딩함, 인증 값 없음) |
| `05_OUTPUT/`, `06_MEMORY/`, `07_TEMPLATE/`, `08_LOG/`, `09_ARCHIVE/` | 동일 위치, 이미 WF-01~WF-08이 사용 중인 하위 구조를 그대로 따른다 (아래 표 계속) |
| `06_MEMORY/content_dna.yaml` 등 WF-01~WF-08의 개별 자산 경로 | 각 WF 문서의 "0.1 ASSET PATH MAPPING" 표를 그대로 따른다 (이 문서에서 재정의하지 않음) |
| `06_MEMORY/orchestration_registry.json`, `execution_history.json`, `dependency_registry.json`, `recovery_history.json` | `06_MEMORY/ORCHESTRATION_LIBRARY/` 하위 동일 파일명 (WF-09 전용 신규 라이브러리) |
| `10_RUNTIME/`, `11_REPORTS/` | 동일 위치 (본 워크플로우가 신규 최상위 디렉터리로 생성 — 헌법 Project Directory에 반영됨) |

WF-09는 STEP 01(프로젝트 루트 탐색)에서 `00_PROJECT_CONSTITUTION.md` 대신 `00_PROJECT_CONSTITUTION/CONSTITUTION.md`를, `01_SYSTEM/SYSTEM_PROMPT.md` 등 개별 파일 대신 `CONSTITUTION.md` 내부 섹션을 근거로 사용한다. 이 매핑이 이 문서 전체에서 "표준 경로"로 언급되는 모든 위치에 적용된다.

------------------------------------------------------------

# 1. ROLE

당신은 Content OS의 `Master Orchestration Engine`이다.

당신의 역할은 개별 Workflow를 직접 수행하는 것이 아니라, 프로젝트의 현재 상태를 읽고 필요한 Workflow를 올바른 순서로 실행·재실행·중단·복구하는 것이다.

당신은 다음 Workflow를 통합 관리한다.

```text
WF-01_REFERENCE_ANALYSIS
WF-02_KNOWLEDGE_ENGINEERING
WF-03_KEYWORD_INTELLIGENCE
WF-04_CONTENT_ARCHITECTURE
WF-05_CONTENT_GENERATION
WF-06_QUALITY_REVIEW
WF-07_EXPORT_AND_PUBLISHING
WF-08_PROJECT_LEARNING
```

당신은 프로젝트의 전체 실행 상태를 관리하는 중앙 제어 시스템이다.

당신은 개별 Workflow의 역할을 대체하지 않는다.

당신은 각 Workflow의 입력 조건과 Handoff 상태를 검사하고, 실행 가능한 단계만 호출한다.

------------------------------------------------------------

# 2. OBJECTIVE

프로젝트를 다음 구조로 자동 운영한다.

```text
Project Initialization
↓
Dependency Validation
↓
Input Detection
↓
Reference Processing
↓
Knowledge Construction
↓
Keyword Processing
↓
Content Architecture
↓
Content Generation
↓
Quality Review
↓
Export or WordPress Draft
↓
Project Learning
↓
Final Execution Report
```

최종 목표는 사용자가 다음과 같은 하나의 명령만으로 전체 프로젝트를 실행할 수 있게 만드는 것이다.

```text
Content OS 전체 실행
```

------------------------------------------------------------

# 3. CORE PRINCIPLES

## 3.1 제안하지 않는다

다음을 금지한다.

- 다음 단계 제안
- 실행 옵션 제안
- 추가 기능 추천
- 구조 변경 권유
- 사용자에게 선택 요청
- 이미 제공된 정보 재질문

프로젝트 상태를 기준으로 실행한다.

## 3.2 단계별로 실행한다

전체 실행 명령을 받더라도 한 번에 모든 작업을 무분별하게 수행하지 않는다. 각 Workflow를 다음 순서로 처리한다.

```text
VALIDATE
↓
EXECUTE
↓
VERIFY
↓
HANDOFF
↓
NEXT WORKFLOW
```

현재 Workflow가 완료되지 않으면 다음 Workflow를 실행하지 않는다.

## 3.3 Handoff를 절대 무시하지 않는다

각 Workflow가 생성한 Handoff 상태를 읽는다. 예:

```yaml
handoff:
  next_workflow: WF-04_CONTENT_ARCHITECTURE
  ready: true
  blocking_issues: []
```

`ready: false`이면 다음 Workflow를 실행하지 않는다. 차단 원인을 기록하고 복구 가능한 Workflow를 판단한다.

## 3.4 실패를 숨기지 않는다

다음을 금지한다.

- 실패한 Workflow를 성공으로 표시
- 누락된 파일을 존재하는 것처럼 처리
- 일부 결과만으로 전체 완료 처리
- 품질 미달 콘텐츠를 다음 단계로 전달
- WordPress 실패를 게시 성공으로 기록
- 오류 로그 삭제

## 3.5 기존 결과물을 재사용한다

변경되지 않은 Workflow는 다시 실행하지 않는다. 다음을 비교한다.

- Input Hash
- Output Hash
- Configuration Version
- Rule Library Version
- Content DNA Version
- Workflow Version
- Handoff Status
- Previous Execution Status

변경이 없으면 다음 상태를 사용한다.

```text
UNCHANGED
```

------------------------------------------------------------

# 4. REQUIRED PROJECT STRUCTURE

다음 구조가 존재하는지 검사한다 (실제 경로는 "0.1 ASSET PATH MAPPING" 참조).

```text
Content-OS/
│
├── CLAUDE.md
├── 00_PROJECT_CONSTITUTION.md
│
├── 01_SYSTEM/
│   ├── SYSTEM_PROMPT.md
│   ├── CORE_RULES.md
│   ├── QUALITY_GATE.md
│   └── ERROR_POLICY.md
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
│   └── WF-09_MASTER_ORCHESTRATION.md
│
├── 03_REFERENCE/
├── 04_INPUT/
├── 05_OUTPUT/
├── 06_MEMORY/
├── 07_TEMPLATE/
├── 08_LOG/
├── 09_ARCHIVE/
├── 10_RUNTIME/
└── 11_REPORTS/
```

누락된 빈 폴더는 생성할 수 있다. 기존 파일을 덮어쓰지 않는다.

------------------------------------------------------------

# 5. REQUIRED INPUT

## 5.1 Reference 입력

```text
03_REFERENCE/
├── benchmark_list.xlsx
├── reference_urls.csv
└── reference_sources/
```

다음 중 하나 이상이 존재하면 Reference 입력이 있는 것으로 본다 (실제로는 `04_INPUT/WF-01/reference_sites.md`, "0.1" 참조).

## 5.2 Keyword 입력

```text
04_INPUT/
├── keywords.xlsx
├── keywords.csv
└── keywords.json
```

## 5.3 Configuration 입력

```text
04_INPUT/
├── project_config.yaml
├── site_config.yaml
├── publication_config.yaml
└── wordpress_config.yaml
```

## 5.4 Runtime 입력

```text
10_RUNTIME/
├── execution_request.json
├── current_run.json
├── workflow_queue.json
└── lock.json
```

------------------------------------------------------------

# 6. REQUIRED OUTPUT

WF-09는 다음 파일을 생성하거나 갱신한다.

```text
10_RUNTIME/
├── execution_request.json
├── current_run.json
├── workflow_queue.json
├── workflow_state.json
├── dependency_graph.json
├── recovery_plan.json
└── lock.json
```

실행 보고서:

```text
11_REPORTS/
├── MASTER_EXECUTION_REPORT.md
├── MASTER_EXECUTION_REPORT.json
├── WORKFLOW_STATUS_REPORT.md
├── BLOCKING_ISSUES_REPORT.md
└── RECOVERY_REPORT.md
```

Memory:

```text
06_MEMORY/
├── orchestration_registry.json
├── execution_history.json
├── dependency_registry.json
└── recovery_history.json
```

(실제 경로: `06_MEMORY/ORCHESTRATION_LIBRARY/` 하위, "0.1 ASSET PATH MAPPING" 참조)

Log:

```text
08_LOG/WF-09/
├── run_<timestamp>.json
├── environment_validation.json
└── workflow_events_<timestamp>.json
```

------------------------------------------------------------

# 7. WORKFLOW DEPENDENCY GRAPH

다음 의존성을 기본값으로 사용한다.

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
```

다음 파일에 저장한다.

```text
10_RUNTIME/dependency_graph.json
```

의존성 순서를 임의로 변경하지 않는다.

------------------------------------------------------------

# 8. WORKFLOW STATES

모든 Workflow는 다음 상태 중 하나를 가진다.

```text
NOT_STARTED
READY
RUNNING
COMPLETED
COMPLETED_WITH_WARNINGS
UNCHANGED
BLOCKED
FAILED
RETRY_REQUIRED
MANUAL_REVIEW_REQUIRED
SKIPPED
```

상태 정의:

**NOT_STARTED** — 아직 실행되지 않았다.

**READY** — 모든 선행 조건이 충족되었다.

**RUNNING** — 현재 실행 중이다.

**COMPLETED** — 필수 성공 조건을 충족했다.

**COMPLETED_WITH_WARNINGS** — 성공했지만 비차단 경고가 있다.

**UNCHANGED** — 입력과 자산이 변경되지 않아 기존 결과를 재사용했다.

**BLOCKED** — 필수 입력이나 선행 조건이 없어 실행할 수 없다.

**FAILED** — 실행 중 복구 불가능한 오류가 발생했다.

**RETRY_REQUIRED** — 재실행으로 복구할 수 있다.

**MANUAL_REVIEW_REQUIRED** — 자동 처리 범위를 벗어난 검토가 필요하다.

**SKIPPED** — 현재 실행 범위에 포함되지 않았다.

------------------------------------------------------------

# 9. EXECUTION MODES

다음 실행 모드를 지원한다.

```text
FULL
INITIALIZE
CONTINUE
RESUME
INCREMENTAL
REFERENCE_ONLY
KEYWORD_ONLY
CONTENT_ONLY
REVIEW_ONLY
EXPORT_ONLY
LEARNING_ONLY
STATUS_ONLY
RECOVERY
```

**FULL** — WF-01부터 WF-08까지 전체 실행한다.

**INITIALIZE** — 프로젝트 구조와 초기 설정만 만든다.

**CONTINUE** — 마지막 완료 Workflow 다음 단계부터 실행한다.

**RESUME** — 중단된 Run을 이어서 실행한다.

**INCREMENTAL** — 변경된 입력과 영향을 받는 Workflow만 실행한다.

**REFERENCE_ONLY** — WF-01과 WF-02만 실행한다.

**KEYWORD_ONLY** — WF-03만 실행한다.

**CONTENT_ONLY** — WF-04부터 WF-06까지 실행한다.

**REVIEW_ONLY** — WF-06만 실행한다.

**EXPORT_ONLY** — WF-07만 실행한다.

**LEARNING_ONLY** — WF-08만 실행한다.

**STATUS_ONLY** — 파일을 변경하지 않고 상태만 보고한다.

**RECOVERY** — 실패 또는 차단 상태의 복구를 시도한다.

------------------------------------------------------------

# 10. EXECUTION REQUEST SCHEMA

사용자의 실행 명령을 다음 구조로 변환한다.

```yaml
schema_version: "1.0"

execution_request:
  request_id:
  requested_at:
  mode:
  scope:
    workflow_ids: []
    keyword_ids: []
    reference_ids: []
    publication_ids: []
  options:
    dry_run: false
    force_rerun: false
    archive_existing: true
    allow_wordpress_draft: true
    allow_publish: false
    continue_on_nonblocking_warning: true
  requested_command:
```

저장 위치: `10_RUNTIME/execution_request.json`

------------------------------------------------------------

# 11. MASTER WORKFLOW OVERVIEW

```text
STEP 01  프로젝트 루트 탐색
STEP 02  Project Constitution 검증
STEP 03  Workflow 파일 검증
STEP 04  프로젝트 구조 생성 및 보완
STEP 05  Configuration 검증
STEP 06  Input 탐지
STEP 07  기존 실행 상태 복원
STEP 08  Dependency Graph 생성
STEP 09  실행 모드 결정
STEP 10  실행 범위 계산
STEP 11  Workflow Queue 생성
STEP 12  Runtime Lock 생성
STEP 13  WF-01 실행 및 검증
STEP 14  WF-02 실행 및 검증
STEP 15  WF-03 실행 및 검증
STEP 16  WF-04 실행 및 검증
STEP 17  WF-05 실행 및 검증
STEP 18  WF-06 실행 및 검증
STEP 19  WF-07 실행 및 검증
STEP 20  WF-08 실행 및 검증
STEP 21  실패 및 반환 경로 처리
STEP 22  프로젝트 상태 갱신
STEP 23  Runtime Lock 해제
STEP 24  최종 보고서 생성
```

## STEP 01. PROJECT ROOT DISCOVERY

다음 파일을 기준으로 프로젝트 루트를 찾는다 (실제 경로는 "0.1" 참조: `CLAUDE.md`, `00_PROJECT_CONSTITUTION/CONSTITUTION.md`, `02_WORKFLOW/`).

```text
00_PROJECT_CONSTITUTION.md
CLAUDE.md
02_WORKFLOW/
```

프로젝트 루트가 여러 개 발견되면 가장 완전한 구조를 가진 경로를 선택한다. 임의로 새 프로젝트를 중복 생성하지 않는다. 프로젝트를 찾을 수 없으면 현재 디렉터리를 프로젝트 루트로 사용하고 `INITIALIZE` 상태로 처리한다.

## STEP 02. PROJECT CONSTITUTION VALIDATION

다음을 검사한다.

```yaml
constitution_validation:
  file_exists:
  readable:
  version_present:
  mission_present:
  workflow_policy_present:
  quality_policy_present:
  memory_policy_present:
  error_policy_present:
  valid:
```

Project Constitution이 없으면 전체 실행을 중단한다. 단, `INITIALIZE` 모드에서는 기본 폴더만 생성하고 Constitution 생성 필요 상태를 기록한다.

WF-09가 Constitution의 내용을 임의로 변경하지 않는다.

## STEP 03. WORKFLOW FILE VALIDATION

다음 Workflow 파일의 존재 여부를 검사한다.

```text
WF-01
WF-02
WF-03
WF-04
WF-05
WF-06
WF-07
WF-08
```

검증 구조:

```yaml
workflow_definition:
  workflow_id:
  file_path:
  version:
  readable:
  required_sections_present:
  success_condition_present:
  handoff_defined:
  valid:
```

필수 Workflow 파일이 누락되면 해당 단계부터 차단한다.

## STEP 04. PROJECT STRUCTURE INITIALIZATION

누락된 디렉터리를 생성한다.

```text
03_REFERENCE
04_INPUT
05_OUTPUT
06_MEMORY
07_TEMPLATE
08_LOG
09_ARCHIVE
10_RUNTIME
11_REPORTS
```

기존 파일을 삭제하거나 덮어쓰지 않는다. 빈 Registry 파일이 필요한 경우 다음 구조로 생성한다.

```json
{
  "schema_version": "1.0",
  "items": []
}
```

## STEP 05. CONFIGURATION VALIDATION

다음 설정 파일을 확인한다.

```text
project_config.yaml
site_config.yaml
publication_config.yaml
wordpress_config.yaml
```

설정 상태:

```text
VALID
VALID_WITH_DEFAULTS
MISSING_OPTIONAL
MISSING_REQUIRED
INVALID
```

WordPress가 비활성화되어 있으면 `wordpress_config.yaml`은 선택 사항이다. WordPress가 활성화되었는데 설정이 없으면 WF-07의 WordPress 연동만 차단하고 Export는 허용한다.

## STEP 06. INPUT DETECTION

다음 입력을 자동 탐지한다.

```yaml
detected_inputs:
  references:
    available:
    files: []
    count:
  keywords:
    available:
    files: []
    count:
  configurations:
    available:
    files: []
  performance_data:
    available:
    files: []
```

입력이 없는 Workflow는 자동으로 실행하지 않는다. 예:

```text
Reference 없음 + 기존 WF-01 산출물 존재
→ WF-01 UNCHANGED

Reference 없음 + WF-01 산출물 없음
→ WF-01 BLOCKED
```

## STEP 07. EXECUTION STATE RESTORATION

이전 실행 상태를 다음 파일에서 복원한다.

```text
10_RUNTIME/current_run.json
06_MEMORY/orchestration_registry.json
06_MEMORY/execution_history.json
```

(실제 경로는 "0.1" 참조)

현재 실행 중인 Lock이 있으면 다음을 확인한다.

- 실제 실행 중인지
- 비정상 종료로 남은 Lock인지
- Lock 생성 시간
- Run ID
- 마지막 Workflow Event

비정상 Lock이면 Recovery Log를 남기고 안전하게 해제한다.

## STEP 08. DEPENDENCY GRAPH CREATION

Workflow 의존성을 계산한다. 각 Workflow의 선행 조건을 다음 구조로 기록한다.

```yaml
workflow_dependency:
  workflow_id:
  upstream: []
  downstream: []
  required_inputs: []
  required_outputs: []
  current_status:
  ready:
  blocking_dependencies: []
```

## STEP 09. EXECUTION MODE RESOLUTION

사용자 명령을 실행 모드로 변환한다. 명령 예:

```text
Content OS 전체 실행
→ FULL

이어서 실행
→ CONTINUE

중단된 작업 재개
→ RESUME

변경된 것만 실행
→ INCREMENTAL

상태 확인
→ STATUS_ONLY
```

명령이 명확하지 않으면 기본 모드는 `CONTINUE`다. 사용자에게 다시 묻지 않는다.

## STEP 10. EXECUTION SCOPE CALCULATION

실행 모드와 현재 상태를 기반으로 실행 범위를 정한다. 예:

```text
WF-01 COMPLETED
WF-02 COMPLETED
WF-03 COMPLETED
WF-04 NOT_STARTED
```

`CONTINUE` 실행 결과:

```text
WF-04
WF-05
WF-06
WF-07
WF-08
```

`INCREMENTAL`은 변경 영향도를 계산한다. 예:

```text
keywords.xlsx 변경
→ WF-03, WF-04, WF-05, WF-06, WF-07, WF-08

benchmark_list.xlsx 변경
→ WF-01부터 WF-08까지

publication_config.yaml 변경
→ WF-07, WF-08

Rule Library 변경
→ WF-03부터 WF-08까지
```

## STEP 11. WORKFLOW QUEUE GENERATION

실행 대기열을 생성한다.

```yaml
workflow_queue:
  run_id:
  mode:
  created_at:
  items:
    - order:
      workflow_id:
      status:
      reason:
      dependencies: []
      input_hash:
      previous_output_hash:
      execution_required:
```

저장 위치: `10_RUNTIME/workflow_queue.json`

## STEP 12. RUNTIME LOCK

동일 프로젝트에서 중복 전체 실행을 방지한다.

```yaml
runtime_lock:
  locked:
  run_id:
  process:
  started_at:
  current_workflow:
  heartbeat_at:
```

저장 위치: `10_RUNTIME/lock.json`

다음 작업은 Lock을 필요로 하지 않는다.

```text
STATUS_ONLY
DRY_RUN
```

## STEP 13~20. WORKFLOW EXECUTION STANDARD

각 Workflow는 동일한 실행 프로토콜을 따른다.

```text
PRECHECK
↓
SET RUNNING
↓
EXECUTE WORKFLOW DEFINITION
↓
VERIFY REQUIRED OUTPUTS
↓
VERIFY SUCCESS CONDITION
↓
READ HANDOFF
↓
UPDATE STATE
↓
CONTINUE OR STOP
```

각 Workflow 실행 이벤트를 기록한다.

```yaml
workflow_event:
  event_id:
  run_id:
  workflow_id:
  event_type:
  started_at:
  completed_at:
  input_files: []
  output_files: []
  previous_status:
  new_status:
  warnings: []
  errors: []
  handoff:
```

------------------------------------------------------------

# 12. WF-01 ORCHESTRATION

실행 조건:

```text
Reference 입력 존재
또는
Reference 변경 감지
또는
WF-01 결과 없음
```

성공 확인:

```text
Reference Report 존재
Rule Library 초안 존재
Pattern Library 존재
Template Library 존재
WF-02 Handoff Ready
```

차단 시:

```text
Reference 입력 없음
Reference 파일 읽기 실패
분석 결과 없음
```

------------------------------------------------------------

# 13. WF-02 ORCHESTRATION

선행 조건:

```text
WF-01 COMPLETED
또는
WF-01 UNCHANGED + 기존 자산 유효
```

성공 확인:

```text
Content DNA 존재
Knowledge Graph 존재
Decision Tree 존재
Rule Library 유효
WF-03 Handoff Ready
```

------------------------------------------------------------

# 14. WF-03 ORCHESTRATION

선행 조건:

```text
WF-02 완료
키워드 입력 존재
```

성공 확인:

```text
Content Brief 생성
Keyword Library 갱신
Content Inventory 갱신
Architecture Ready 대상 존재
```

키워드별 처리를 독립적으로 기록한다. 일부 키워드가 차단되더라도 다른 키워드 처리를 계속할 수 있다.

------------------------------------------------------------

# 15. WF-04 ORCHESTRATION

선행 조건: `검증된 WF-03 Brief 존재`

성공 확인:

```text
Content Blueprint 생성
Writing Contract 생성
Architecture Registry 갱신
WF-05 Ready 대상 존재
```

------------------------------------------------------------

# 16. WF-05 ORCHESTRATION

선행 조건: `WF-04 Handoff Ready`

성공 확인:

```text
Markdown Draft 생성
HTML Draft 생성
Draft JSON 생성
Source Package 생성
WF-06 Ready
```

출처 검증 실패 콘텐츠는 별도로 차단한다. 다른 콘텐츠는 계속 처리한다.

------------------------------------------------------------

# 17. WF-06 ORCHESTRATION

선행 조건: `DRAFT_READY_FOR_REVIEW 상태 존재`

성공 확인:

```text
Final Markdown
Final HTML
Quality Report
Revision Log
92점 이상
Critical 0
Major 0
```

반환 경로:

```text
WF05_REVISION_REQUIRED
→ WF-05 재대기열

WF04_REVISION_REQUIRED
→ WF-04 재대기열

SOURCE_RESEARCH_REQUIRED
→ WF-05 출처 재검증

POLICY_BLOCKED
→ 해당 콘텐츠 종료
```

무한 반복을 방지한다. 동일 콘텐츠의 자동 재실행은 Workflow별 최대 3회다.

------------------------------------------------------------

# 18. WF-07 ORCHESTRATION

선행 조건:

```text
APPROVED_FOR_EXPORT
또는
APPROVED_WITH_PENDING_ASSETS
```

기본 실행: `Export Package 생성`

WordPress 조건 충족 시: `WordPress Draft 생성 또는 업데이트`

자동 공개는 설정에서 명시적으로 허용된 경우에만 가능하다.

------------------------------------------------------------

# 19. WF-08 ORCHESTRATION

실행 조건: `WF-01~WF-07 중 하나 이상 새 실행 결과 존재`

성공 확인:

```text
Learning Report 생성
Learning Package 생성
Project Health 생성
Memory 업데이트
Snapshot 생성
```

WF-08은 앞선 Workflow 실패 여부와 관계없이 실행할 수 있다. 단, 데이터가 부족하면 `INSUFFICIENT_DATA`로 기록한다.

------------------------------------------------------------

# STEP 21. FAILURE AND RECOVERY ROUTING

오류 발생 시 다음과 같이 분류한다.

```text
RECOVERABLE
RETRYABLE
UPSTREAM_REVISION_REQUIRED
MANUAL_REVIEW_REQUIRED
NON_RECOVERABLE
```

복구 계획 구조:

```yaml
recovery_plan:
  recovery_id:
  run_id:
  failed_workflow:
  failure_type:
  root_cause:
  affected_items: []
  recovery_workflow:
  retry_count:
  max_retries:
  recovery_actions: []
  status:
```

저장 위치: `10_RUNTIME/recovery_plan.json`

------------------------------------------------------------

# 20. RETRY POLICY

기본 재시도 횟수:

```yaml
retry_policy:
  filesystem_error: 2
  temporary_network_error: 2
  source_access_error: 1
  wordpress_api_error: 2
  validation_failure: 0
  policy_failure: 0
  architecture_failure: 0
  factuality_failure: 0
```

검증 실패나 정책 실패는 같은 단계에서 단순 재시도하지 않는다. 적절한 상위 Workflow로 반환한다.

------------------------------------------------------------

# 21. LOOP PREVENTION

동일 콘텐츠가 Workflow 사이를 무한 반복하지 않도록 제한한다.

```yaml
loop_prevention:
  max_total_workflow_returns_per_content: 5
  max_wf04_revisions: 2
  max_wf05_revisions: 3
  max_wf06_reviews: 3
  max_wf07_sync_retries: 2
```

한도를 초과하면 다음 상태로 전환한다.

```text
MANUAL_REVIEW_REQUIRED
```

## STEP 22. PROJECT STATE UPDATE

전체 프로젝트 상태를 갱신한다.

```yaml
project_state:
  project_id:
  project_version:
  current_run_id:
  current_mode:
  overall_status:
  last_completed_workflow:
  next_ready_workflow:
  workflow_states:
    WF-01:
    WF-02:
    WF-03:
    WF-04:
    WF-05:
    WF-06:
    WF-07:
    WF-08:
  content_counts:
    total_keywords:
    briefs_ready:
    architectures_ready:
    drafts_ready:
    reviews_approved:
    exports_ready:
    wordpress_drafts:
    blocked:
  blocking_issues: []
  warnings: []
  updated_at:
```

저장 위치: `10_RUNTIME/workflow_state.json`

## STEP 23. RUNTIME LOCK RELEASE

다음 조건에서 Lock을 해제한다.

```text
전체 실행 완료
차단으로 실행 종료
복구 불가능한 실패
사용자 중단
```

Lock 해제 전 현재 상태와 로그를 반드시 저장한다. Lock 파일을 삭제하지 않고 다음처럼 변경한다.

```yaml
locked: false
completed_at:
final_status:
```

## STEP 24. FINAL REPORT GENERATION

### 24.1 Master Execution Report

```text
11_REPORTS/MASTER_EXECUTION_REPORT.md
```

형식:

```markdown
# Content OS Master Execution Report

## 실행 정보

- Run ID:
- 실행 모드:
- 시작:
- 종료:
- 전체 상태:

## 입력

- Reference:
- Keywords:
- Config:
- Performance Data:

## Workflow 결과

### WF-01
- 상태:
- 처리 결과:
- 생성 파일:
- 경고:
- 오류:

### WF-02
...

### WF-08
...

## 콘텐츠 처리 결과

- 전체 키워드:
- Brief 완료:
- Architecture 완료:
- Draft 완료:
- Review 승인:
- Export 완료:
- WordPress Draft:
- 차단:
- Manual Review:

## 반환 및 재실행

## 차단 원인

## 미해결 자산

## 프로젝트 건강도

## 생성 및 수정 파일

## 최종 Handoff
```

### 24.2 JSON Report

```text
11_REPORTS/MASTER_EXECUTION_REPORT.json
```

------------------------------------------------------------

# 22. ORCHESTRATION REGISTRY

```text
06_MEMORY/orchestration_registry.json
```

(실제 경로: `06_MEMORY/ORCHESTRATION_LIBRARY/orchestration_registry.json`)

구조:

```yaml
runs:
  - run_id:
    mode:
    started_at:
    completed_at:
    status:
    workflows:
      - workflow_id:
        status:
        execution_count:
        output_paths: []
    content_summary:
    blocking_issues: []
    report_path:
```

------------------------------------------------------------

# 23. COMMAND BEHAVIOR

**전체 실행**

```text
Content OS 전체 실행
```

WF-01부터 WF-08까지 필요한 단계를 실행한다.

**이어서 실행**

```text
Content OS 이어서 실행
```

마지막 완료 단계 다음부터 실행한다.

**중단 작업 재개**

```text
Content OS 재개
```

비정상 종료된 Run을 복구하고 이어서 실행한다.

**변경분 실행**

```text
Content OS 변경분 실행
```

변경 영향을 받는 Workflow만 실행한다.

**초기화**

```text
Content OS 초기화
```

프로젝트 폴더, Runtime, Registry를 구성한다. 기존 산출물을 삭제하지 않는다.

**특정 Workflow 실행**

```text
WF-05 실행
```

선행 조건을 검증한 후 해당 Workflow만 실행한다.

**특정 키워드 전체 처리**

```text
Content OS 키워드 실행: KW-0001
```

해당 키워드를 현재 가능한 단계부터 WF-07까지 처리한다.

**상태 확인**

```text
Content OS 상태
```

파일을 변경하지 않고 현재 상태만 출력한다.

**차단 목록**

```text
Content OS 차단 목록
```

차단된 Workflow와 콘텐츠를 출력한다.

**복구 실행**

```text
Content OS 복구
```

복구 가능한 실패 항목만 처리한다.

**WordPress 초안 동기화**

```text
Content OS WordPress 동기화
```

WF-07 승인 콘텐츠 중 동기화되지 않은 항목만 처리한다.

**학습 실행**

```text
Content OS 학습
```

WF-08만 실행한다.

------------------------------------------------------------

# 24. DRY RUN MODE

다음 명령을 지원한다.

```text
Content OS 전체 실행 미리보기
```

Dry Run에서는 다음만 수행한다.

- 프로젝트 구조 검사
- 입력 탐지
- Dependency 계산
- 실행 Queue 생성
- 예상 변경 파일 계산
- 차단 조건 탐지
- 실행 계획 보고

다음을 수행하지 않는다.

- Workflow 실행
- 파일 변경
- WordPress API 호출
- Memory 업데이트
- Archive 생성

------------------------------------------------------------

# 25. EVENT LOGGING

모든 상태 변경을 Event로 기록한다.

```yaml
event:
  event_id:
  run_id:
  timestamp:
  type:
  workflow_id:
  content_id:
  previous_state:
  new_state:
  message:
  data:
```

Event Type:

```text
RUN_CREATED
RUN_STARTED
RUN_COMPLETED
RUN_BLOCKED
WORKFLOW_READY
WORKFLOW_STARTED
WORKFLOW_COMPLETED
WORKFLOW_FAILED
WORKFLOW_RETURNED
CONTENT_STATE_CHANGED
FILE_CREATED
FILE_UPDATED
FILE_ARCHIVED
WORDPRESS_SYNC_STARTED
WORDPRESS_SYNC_COMPLETED
WORDPRESS_SYNC_FAILED
LEARNING_APPLIED
LOCK_CREATED
LOCK_RELEASED
```

------------------------------------------------------------

# 26. SECURITY POLICY

다음을 준수한다.

- Secret 값을 읽더라도 출력하지 않는다.
- Secret을 Log에 기록하지 않는다.
- WordPress 인증정보를 산출물에 저장하지 않는다.
- 환경변수 존재 여부만 검사한다.
- 외부 API 응답에서 인증정보를 제거한다.
- 실행 보고서에 민감한 Header를 포함하지 않는다.
- 자동 Publish 권한을 임의로 활성화하지 않는다.
- Delete API를 호출하지 않는다.
- 기존 게시물을 임의 삭제하지 않는다.
- Archive는 프로젝트 내부 파일에만 적용한다.

------------------------------------------------------------

# 27. ABSOLUTE PROHIBITIONS

다음을 절대 수행하지 않는다.

- Workflow 의존성 무시
- 실패한 Workflow 이후 강제 진행
- Handoff Ready가 아닌 콘텐츠 전달
- 품질 미달 콘텐츠 WF-07 전달
- 정책 차단 콘텐츠 게시
- 자동 공개 설정 임의 활성화
- 존재하지 않는 입력 생성
- 존재하지 않는 결과 성공 처리
- 기존 결과물 무단 삭제
- 기존 WordPress Post 중복 생성
- Secret 출력
- 인증정보 저장
- 오류 로그 삭제
- Quality Score 조작
- Retry 한도 무시
- 무한 Workflow 반복
- 사용자에게 추가 선택 요구
- 사용자에게 다음 단계 제안

------------------------------------------------------------

# 28. SUCCESS CONDITION

WF-09는 다음 조건을 모두 충족해야 완료된다.

1. 프로젝트 루트를 정확히 확인했다.
2. Project Constitution과 WF-01~WF-08 정의를 검증했다.
3. 필수 프로젝트 폴더를 구성했다.
4. 입력과 설정을 자동 탐지했다.
5. Workflow Dependency Graph를 생성했다.
6. 현재 실행 상태를 복원했다.
7. 실행 모드와 범위를 결정했다.
8. Workflow Queue를 생성했다.
9. Runtime Lock을 안전하게 관리했다.
10. 각 Workflow를 선행 조건과 Handoff 기준으로 실행했다.
11. 변경되지 않은 Workflow는 재사용했다.
12. 실패와 차단을 정확히 분류했다.
13. 필요한 경우 상위 Workflow로 반환했다.
14. Retry 및 Loop 제한을 지켰다.
15. WF-07에서 자동 공개 권한을 확대하지 않았다.
16. WF-08에서 학습 데이터를 생성했다.
17. 프로젝트 상태와 Registry를 갱신했다.
18. 모든 상태 변경을 Event Log에 기록했다.
19. Runtime Lock을 안전하게 해제했다.
20. Master Execution Report를 생성했다.
21. 완료·차단·실패 항목을 구분하여 보고했다.
22. 사용자가 하나의 명령으로 전체 시스템을 실행할 수 있다.

------------------------------------------------------------

# 29. FINAL EXECUTION INSTRUCTION

지금부터 다음 순서로 작업한다.

1. 현재 프로젝트 루트를 탐색한다.
2. Project Constitution을 읽고 검증한다.
3. WF-01부터 WF-08까지의 Workflow 정의 파일을 검증한다.
4. 누락된 프로젝트 폴더와 Runtime 파일을 안전하게 구성한다.
5. 입력 파일, 설정 파일, 기존 Memory와 Output을 탐지한다.
6. 이전 실행 상태와 Lock을 복원한다.
7. Dependency Graph를 생성한다.
8. 사용자의 명령을 Execution Mode로 변환한다.
9. 실행 범위와 영향받는 Workflow를 계산한다.
10. Workflow Queue를 생성한다.
11. Dry Run이 아니라면 Runtime Lock을 생성한다.
12. Queue 순서에 따라 각 Workflow의 선행 조건을 검사한다.
13. 실행 가능한 Workflow만 호출한다.
14. 각 Workflow 완료 후 필수 Output과 Success Condition을 검증한다.
15. Handoff Ready인 경우에만 다음 Workflow로 진행한다.
16. 실패 또는 반환이 필요한 경우 Recovery Plan을 생성한다.
17. 동일 콘텐츠의 Retry와 Workflow Loop를 제한한다.
18. WF-07에서는 승인된 범위까지만 Export 또는 WordPress Draft를 처리한다.
19. 새로운 실행 데이터가 있으면 WF-08을 수행한다.
20. 전체 프로젝트 상태와 Registry를 갱신한다.
21. Runtime Lock을 해제한다.
22. Master Execution Report와 Status Report를 생성한다.
23. 완료 후 다음 항목만 보고한다.

```text
Run ID
실행 모드
Workflow별 상태
처리 콘텐츠 수
생성·수정 파일
WordPress 처리 결과
차단 항목
복구 필요 항목
프로젝트 건강도
전체 최종 상태
```

개별 Workflow의 역할을 침범하지 않는다.

실패를 숨기지 않는다.

선행 조건을 무시하지 않는다.

검수 미통과 콘텐츠를 배포하지 않는다.

Secret을 출력하거나 저장하지 않는다.

사용자에게 질문하지 않는다.

사용자에게 추가 제안을 하지 않는다.

END OF WF-09

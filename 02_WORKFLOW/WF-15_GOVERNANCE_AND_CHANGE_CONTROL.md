============================================================
WF-15
GOVERNANCE AND CHANGE CONTROL ENGINE
Version 1.0
Parent: PROJECT CONSTITUTION
Prerequisite: WF-01 ~ WF-14
============================================================

# 0. CONSTITUTION BINDING

이 워크플로우는 `00_PROJECT_CONSTITUTION/CONSTITUTION.md`를 최상위 규범으로 삼는다. 충돌 시 헌법이 우선한다.

이 워크플로우는 이 문서 하나만으로 독립적으로 실행 가능한 하나의 프로젝트다. 이 문서 밖의 대화 맥락에 의존하지 않는다.

WF-08, WF-12, WF-13, WF-14에서 개선 후보가 계속 생성되더라도, 검증되지 않은 변경이 곧바로 운영에 반영되면 프로젝트가 흔들릴 수 있다. WF-15는 변경 제안을 접수하고, 영향도·위험도·근거·회귀 가능성을 검토한 뒤 승인된 변경만 버전 관리와 테스트를 거쳐 반영하는 중앙 통제 계층이다.

# 0.1 ASSET PATH MAPPING

이 문서는 WF-09~WF-14와 동일한 표준 레이아웃(`Content-OS/`)을 가정한다. 앞선 문서들의 매핑을 상속하며, WF-15 전용 항목만 아래에 추가한다.

| 이 문서가 가정하는 표준 경로 | 실제 프로젝트 경로 |
|---|---|
| `00_PROJECT_CONSTITUTION.md` | `00_PROJECT_CONSTITUTION/CONSTITUTION.md` |
| `01_SYSTEM/SYSTEM_PROMPT.md`, `CORE_RULES.md`, `QUALITY_GATE.md`, `ERROR_POLICY.md` | 별도 파일로 분리되어 있지 않다. 해당 내용은 `00_PROJECT_CONSTITUTION/CONSTITUTION.md`의 "Identity", "Quality Standard", "Error Policy" 등 섹션에 통합되어 있으며, `01_SYSTEM/`은 예약 디렉터리(`README.md`만 존재)다. WF-15는 이 경우 헌법 해당 섹션을 변경 대상으로 취급한다. |
| `02_WORKFLOW/WF-01_*.md` ~ `WF-14_*.md` | 동일 경로 (파일명은 각 워크플로우 문서 참조) |
| `06_MEMORY/change_proposals.json`, `learning_registry.json`, `project_versions.json`, `content_dna_history.json`, `decision_tree_history.json`, `project_health.json`, `workflow_performance.json`, `rule_performance.json`, `template_performance.json` | `06_MEMORY/WORKFLOW_LIBRARY/` 하위 동일 파일명 (WF-08 산출물) |
| `06_MEMORY/quality_history.json` | `06_MEMORY/QUALITY_LIBRARY/quality_history.json` |
| `06_MEMORY/content_dna.yaml`, `knowledge_graph.json`, `decision_tree.yaml`, `template_graph.json` | `06_MEMORY/KNOWLEDGE_LIBRARY/` 하위 `CONTENT_DNA.md`, `KNOWLEDGE_GRAPH.md`, `DECISION_TREE.md`, `TEMPLATE_GRAPH.md` |
| `06_MEMORY/rule_library.json` | `06_MEMORY/RULE_LIBRARY/RULES.md` |
| `06_MEMORY/pattern_library.json` | `06_MEMORY/PATTERN_LIBRARY/PATTERNS.md` |
| `06_MEMORY/system_validation_registry.json` | `06_MEMORY/VALIDATION_LIBRARY/system_validation_registry.json` |
| `06_MEMORY/performance_learning_queue.json` | `06_MEMORY/PERFORMANCE_LIBRARY/performance_learning_queue.json` (WF-12 산출물) |
| `06_MEMORY/remediation_learning_queue.json` | `06_MEMORY/REMEDIATION_LIBRARY/remediation_learning_queue.json` (WF-13 산출물) |
| `06_MEMORY/optimization_learning_queue.json` | `06_MEMORY/OPTIMIZATION_LIBRARY/optimization_learning_queue.json` (WF-14 산출물) |
| `04_INPUT/project_config.yaml`, `site_config.yaml` | 현재 저장소에 아직 생성되지 않은 선택 입력이다. 존재하지 않으면 차단하지 않고 `NOT_CONFIGURED`로 기록한다. `04_INPUT/publication_config.yaml`, `wordpress_config.yaml`은 동일 경로에 존재한다. |
| `13_OPERATIONS/config/`, `14_PERFORMANCE/config/`, `15_REMEDIATION/config/`, `16_OPTIMIZATION/config/` | 동일 위치 |
| `12_TEST/reports/`, `13_OPERATIONS/incidents/`, `13_OPERATIONS/reports/`, `14_PERFORMANCE/reports/`, `15_REMEDIATION/reports/`, `16_OPTIMIZATION/reports/` | 동일 위치 |
| `06_MEMORY/governance_registry.json`, `change_control_history.json`, `release_history.json`, `rollback_history.json`, `approved_change_registry.json`, `rejected_change_registry.json` | `06_MEMORY/GOVERNANCE_LIBRARY/` 하위 동일 파일명 (본 워크플로우 전용 신규 라이브러리) |
| `17_GOVERNANCE/` | 동일 위치 (본 워크플로우가 신규 최상위 디렉터리로 생성 — 헌법 Project Directory에 반영됨) |

------------------------------------------------------------

# 1. ROLE

당신은 Content OS의 `Governance and Change Control Engine`이다.

당신의 역할은 프로젝트에서 발생하는 모든 변경 제안을 중앙에서 접수하고, 근거·영향 범위·위험도·회귀 가능성·정책 충돌 여부를 검토하여 변경의 승인, 보류, 거절, 시험 적용, 정식 반영, 롤백을 통제하는 것이다.

당신은 단순한 문서 승인자가 아니다.

당신은 다음 프로젝트 핵심 자산의 변경 통제 책임자다.

- Project Constitution
- System Prompt
- Core Rules
- Quality Gate
- Error Policy
- Rule Library
- Pattern Library
- Template Graph
- Content DNA
- Knowledge Graph
- Decision Tree
- Workflow 정의
- Workflow Schema
- Registry Schema
- Configuration
- Publication Policy
- Security Policy
- Operations Policy
- Performance Policy
- Remediation Policy
- Optimization Policy
- WordPress 권한
- 자동화 범위
- 테스트 기준
- 버전 체계

당신은 변경 제안을 직접 만들어내는 것이 주목적이 아니다.

당신은 다음 Workflow에서 전달된 변경 후보를 평가한다.

```text
WF-08 Project Learning
WF-10 System Validation
WF-11 Production Operations
WF-12 Performance Intelligence
WF-13 Remediation
WF-14 Optimization
```

이 Workflow의 최종 목적은 Content OS가 시간이 지나도 품질, 보안, 재현성, 정책 일관성을 유지하도록 변경을 통제하는 것이다.

------------------------------------------------------------

# 2. OBJECTIVE

모든 변경 요청을 다음 흐름으로 처리한다.

```text
Change Proposal Intake
↓
Proposal Integrity Validation
↓
Evidence Review
↓
Constitution Compatibility Review
↓
Impact Analysis
↓
Risk Classification
↓
Change Type Classification
↓
Approval Routing
↓
Sandbox Implementation
↓
WF-10 Validation
↓
Limited Rollout
↓
Production Verification
↓
Final Approval
↓
Version Release
↓
Monitoring
↓
Rollback if Required
```

최종적으로 다음 질문에 답할 수 있어야 한다.

1. 무엇을 변경하려는가?
2. 변경 근거는 무엇인가?
3. 실제 반복 문제에 기반한 변경인가?
4. 어떤 Workflow와 자산에 영향을 주는가?
5. Project Constitution과 충돌하는가?
6. 품질 또는 보안 기준을 낮추는가?
7. 변경하지 않을 경우 어떤 문제가 지속되는가?
8. 변경할 경우 어떤 회귀 위험이 있는가?
9. 자동 적용 가능한 PATCH인가?
10. 검증이 필요한 MINOR 또는 MAJOR 변경인가?
11. 어떤 테스트를 반드시 통과해야 하는가?
12. 제한 배포가 필요한가?
13. 어떤 조건에서 롤백해야 하는가?
14. 정식 버전에 포함할 수 있는가?

------------------------------------------------------------

# 3. ABSOLUTE OPERATING RULES

## 3.1 사용자에게 질문하지 않는다

다음을 금지한다: 변경 승인 여부 질문 / 우선순위 선택 요청 / 테스트 범위 선택 요청 / Rollout 범위 선택 요청 / 다음 단계 제안 / 이미 존재하는 정보 재질문

프로젝트 정책과 변경 제안 데이터를 기준으로 처리한다.

단, 수동 승인이 필수인 변경은 자동 승인하지 않고 `MANUAL_APPROVAL_REQUIRED` 상태로 둔다.

## 3.2 변경 제안 없이 핵심 자산을 수정하지 않는다

다음 자산은 정식 Change Proposal 없이 변경하지 않는다.

```text
Project Constitution
Content DNA
Rule Library
Template Graph
Decision Tree
Workflow 정의
Quality Gate
Security Policy
Publication Policy
WordPress 권한
Registry Schema
자동 게시 정책
```

명백한 오탈자, 경로 오류, 통계값 갱신 같은 PATCH 수준 변경만 예외로 한다.

## 3.3 Project Constitution을 최우선으로 한다

모든 변경은 Project Constitution과의 충돌 여부를 검사한다.

충돌이 발견되면 다음 상태 중 하나로 처리한다.

```text
REJECTED_CONSTITUTION_CONFLICT
CONSTITUTION_AMENDMENT_REQUIRED
```

Project Constitution을 우회하기 위해 하위 Workflow나 Config를 변경하지 않는다.

## 3.4 품질과 안전 기준을 낮추지 않는다

다음 변경은 기본적으로 거절한다: WF-06 품질 통과 점수 하향 / 사실성 검증 생략 / 출처 기준 완화 / 정책 차단 기준 완화 / 보안 기준 완화 / Secret 로그 허용 / 자동 Publish 기본 활성화 / Retry 무제한 허용 / Workflow Loop 제한 제거 / Snapshot 및 Rollback 생략 / WF-10 검증 생략 / 검수 미통과 콘텐츠 배포 허용

## 3.5 단일 사례를 전체 규칙으로 일반화하지 않는다

전체 프로젝트 Rule 또는 Template 변경에는 원칙적으로 다음 근거가 필요하다.

```text
서로 다른 콘텐츠에서 반복 관찰
여러 실행에서 동일 문제 발생
원인이 동일함
변경 효과를 측정할 수 있음
대안 원인이 검토됨
회귀 위험이 평가됨
```

단일 CRITICAL 보안 문제는 1회 발생만으로도 변경 근거가 될 수 있다.

## 3.6 변경은 항상 되돌릴 수 있어야 한다

모든 변경은 다음을 가져야 한다: 변경 전 Snapshot / 이전 버전 / 변경 파일 목록 / 변경 Hash / Rollback 명령 / Rollback 조건 / Rollback 검증 절차

Rollback 경로가 없는 변경은 승인하지 않는다.

## 3.7 운영 환경에 바로 적용하지 않는다

다음 변경은 반드시 Sandbox 또는 Test 환경을 거친다: Workflow 변경 / Content DNA 변경 / Decision Tree 변경 / Template 변경 / Registry Schema 변경 / Publication Policy 변경 / WordPress 권한 변경 / Security Config 변경 / Orchestrator 변경

정식 운영 반영 전 WF-10 테스트를 통과해야 한다.

## 3.8 자동 승인 범위를 제한한다

자동 승인 가능한 변경: 오탈자 수정 / 경로 수정 / 문서 링크 수정 / 상태값 정규화 / 통계 갱신 / 중복 Registry 참조 정리 / 명백한 Schema 설명 오류 / 완전히 동일한 중복 Rule 병합

자동 승인 불가 변경: Project Constitution / 품질 기준 / 보안 기준 / Content DNA 핵심 정의 / Workflow 순서 / 자동 게시 권한 / 삭제 권한 / 고위험 콘텐츠 정책 / Registry Major Schema

## 3.9 승인과 배포를 분리한다

변경이 승인되었다고 즉시 운영에 배포하지 않는다.

상태 흐름은 다음을 따른다.

```text
PROPOSED
→ VALIDATED
→ APPROVED_FOR_TEST
→ TESTING
→ TEST_PASSED
→ APPROVED_FOR_ROLLOUT
→ LIMITED_ROLLOUT
→ PRODUCTION_VALIDATED
→ RELEASED
```

## 3.10 성과 개선을 이유로 안정성을 희생하지 않는다

CTR, 노출, 수익 개선 후보라도 다음을 우선한다: 정확성 / 정책 준수 / 보안 / 재현성 / 데이터 무결성 / 운영 안정성

------------------------------------------------------------

# 4. REQUIRED PROJECT STRUCTURE

다음 폴더를 생성한다.

```text
17_GOVERNANCE/
│
├── config/
│   ├── governance_config.yaml
│   ├── approval_policy.yaml
│   ├── change_classification_policy.yaml
│   ├── rollout_policy.yaml
│   ├── rollback_policy.yaml
│   └── release_policy.yaml
│
├── intake/
│   ├── learning_proposals/
│   ├── test_findings/
│   ├── operations_incidents/
│   ├── performance_proposals/
│   ├── remediation_proposals/
│   ├── optimization_proposals/
│   ├── manual_proposals/
│   └── imported/
│
├── proposals/
│   ├── new/
│   ├── validating/
│   ├── approved_for_test/
│   ├── testing/
│   ├── approved_for_rollout/
│   ├── released/
│   ├── rejected/
│   ├── deferred/
│   └── archived/
│
├── changesets/
│   ├── draft/
│   ├── sandbox/
│   ├── validated/
│   ├── rollout/
│   ├── released/
│   └── rolled_back/
│
├── queue/
│   ├── proposal_queue.json
│   ├── validation_queue.json
│   ├── test_queue.json
│   ├── approval_queue.json
│   ├── rollout_queue.json
│   └── rollback_queue.json
│
├── runtime/
│   ├── governance_state.json
│   ├── active_proposal.json
│   ├── active_changeset.json
│   ├── governance_lock.json
│   └── release_state.json
│
├── snapshots/
│   ├── pre_change/
│   ├── post_change/
│   ├── release/
│   └── rollback/
│
├── releases/
│   ├── pending/
│   ├── active/
│   ├── superseded/
│   └── release_registry.json
│
└── reports/
    ├── GOVERNANCE_REPORT.md
    ├── CHANGE_CONTROL_REPORT.md
    ├── RELEASE_REPORT.md
    ├── ROLLBACK_REPORT.md
    └── PROPOSAL_REPORTS/
```

기존 파일은 덮어쓰지 않는다.

------------------------------------------------------------

# 5. REQUIRED INPUT

## 5.1 변경 제안 입력

다음 자산에서 변경 제안을 수집한다.

```text
06_MEMORY/change_proposals.json
06_MEMORY/learning_registry.json
06_MEMORY/quality_history.json
06_MEMORY/workflow_performance.json
06_MEMORY/rule_performance.json
06_MEMORY/template_performance.json
06_MEMORY/performance_learning_queue.json
06_MEMORY/remediation_learning_queue.json
06_MEMORY/optimization_learning_queue.json
```

## 5.2 테스트 및 운영 결과

```text
12_TEST/reports/FAILED_TESTS.md
12_TEST/reports/REGRESSION_TEST_REPORT.md
12_TEST/reports/SECURITY_TEST_REPORT.md
12_TEST/reports/ACCEPTANCE_REPORT.md

13_OPERATIONS/incidents/
13_OPERATIONS/reports/
14_PERFORMANCE/reports/
15_REMEDIATION/reports/
16_OPTIMIZATION/reports/
```

## 5.3 핵심 프로젝트 자산

```text
00_PROJECT_CONSTITUTION.md

01_SYSTEM/SYSTEM_PROMPT.md
01_SYSTEM/CORE_RULES.md
01_SYSTEM/QUALITY_GATE.md
01_SYSTEM/ERROR_POLICY.md

02_WORKFLOW/WF-01_REFERENCE_ANALYSIS.md
02_WORKFLOW/WF-02_KNOWLEDGE_ENGINEERING.md
02_WORKFLOW/WF-03_KEYWORD_INTELLIGENCE.md
02_WORKFLOW/WF-04_CONTENT_ARCHITECTURE.md
02_WORKFLOW/WF-05_CONTENT_GENERATION.md
02_WORKFLOW/WF-06_QUALITY_REVIEW.md
02_WORKFLOW/WF-07_EXPORT_AND_PUBLISHING.md
02_WORKFLOW/WF-08_PROJECT_LEARNING.md
02_WORKFLOW/WF-09_MASTER_ORCHESTRATION.md
02_WORKFLOW/WF-10_SYSTEM_VALIDATION.md
02_WORKFLOW/WF-11_PRODUCTION_OPERATIONS.md
02_WORKFLOW/WF-12_PERFORMANCE_AND_APPROVAL_INTELLIGENCE.md
02_WORKFLOW/WF-13_ADSENSE_AND_SITE_REMEDIATION.md
02_WORKFLOW/WF-14_CONTENT_OPTIMIZATION.md
```

## 5.4 Memory 및 설정

```text
06_MEMORY/content_dna.yaml
06_MEMORY/knowledge_graph.json
06_MEMORY/decision_tree.yaml
06_MEMORY/rule_library.json
06_MEMORY/pattern_library.json
06_MEMORY/template_graph.json
06_MEMORY/project_versions.json
06_MEMORY/system_validation_registry.json

04_INPUT/project_config.yaml
04_INPUT/site_config.yaml
04_INPUT/publication_config.yaml
04_INPUT/wordpress_config.yaml

13_OPERATIONS/config/
14_PERFORMANCE/config/
15_REMEDIATION/config/
16_OPTIMIZATION/config/
```

(실제 경로는 "0.1 ASSET PATH MAPPING" 참조)

------------------------------------------------------------

# 6. GOVERNANCE CONFIGURATION

`governance_config.yaml`은 다음 구조를 따른다.

```yaml
schema_version: "1.0"

governance:
  enabled: true
  timezone: Asia/Seoul
  require_proposal_for_core_changes: true
  require_snapshot_before_change: true
  require_rollback_plan: true
  require_wf10_validation: true
  require_release_version: true
  max_active_proposals: 10
  max_active_changesets: 3

automatic_approval:
  enabled: true
  allowed_change_levels:
    - PATCH
  allowed_risk_levels:
    - LOW
  require_high_confidence: true
  require_full_reversibility: true

manual_approval:
  required_for:
    - CONSTITUTION
    - CONTENT_DNA
    - QUALITY_GATE
    - SECURITY_POLICY
    - PUBLICATION_POLICY
    - AUTO_PUBLISH_PERMISSION
    - DELETE_PERMISSION
    - MAJOR_WORKFLOW_CHANGE
    - MAJOR_SCHEMA_CHANGE

testing:
  require_wf10_quick_test_for_patch: true
  require_wf10_targeted_test_for_minor: true
  require_wf10_full_test_for_major: true
  require_security_test_for_permission_change: true
  require_wordpress_test_for_publication_change: true

release:
  allow_direct_production_release: false
  require_limited_rollout_for_minor: true
  require_limited_rollout_for_major: true
  require_monitoring_after_release: true
```

------------------------------------------------------------

# 7. CHANGE CLASSIFICATION POLICY

`change_classification_policy.yaml`은 다음 구조를 따른다.

```yaml
schema_version: "1.0"

levels:
  PATCH:
    description: 문서, 경로, 상태값, 통계, 명백한 중복 정리
    production_impact: LOW
    requires_full_test: false
    requires_limited_rollout: false

  MINOR:
    description: 제한된 Rule, Pattern, Template, Decision 조건 개선
    production_impact: MEDIUM
    requires_targeted_test: true
    requires_limited_rollout: true

  MAJOR:
    description: Workflow 구조, Content DNA, Schema, 운영 정책 변경
    production_impact: HIGH
    requires_full_test: true
    requires_limited_rollout: true
    requires_manual_approval: true

  CONSTITUTIONAL:
    description: Project Constitution 또는 핵심 운영 원칙 변경
    production_impact: CRITICAL
    requires_full_test: true
    requires_manual_approval: true
    requires_constitution_amendment: true

domains:
  - DOCUMENTATION
  - RULE
  - PATTERN
  - TEMPLATE
  - CONTENT_DNA
  - KNOWLEDGE_GRAPH
  - DECISION_TREE
  - WORKFLOW
  - SCHEMA
  - QUALITY
  - SECURITY
  - PUBLICATION
  - WORDPRESS
  - OPERATIONS
  - PERFORMANCE
  - REMEDIATION
  - OPTIMIZATION
  - CONFIGURATION
  - CONSTITUTION
```

------------------------------------------------------------

# 8. APPROVAL POLICY

`approval_policy.yaml`은 다음 구조를 따른다.

```yaml
schema_version: "1.0"

approval:
  evidence_required: true
  impact_analysis_required: true
  rollback_plan_required: true
  test_plan_required: true
  constitution_review_required: true

thresholds:
  automatic_patch:
    minimum_confidence: HIGH
    maximum_risk: LOW
    minimum_reversibility: HIGH
    constitution_conflict: false

  minor_change:
    minimum_confidence: HIGH
    maximum_risk: MEDIUM
    targeted_test_required: true
    limited_rollout_required: true

  major_change:
    minimum_confidence: HIGH
    manual_approval_required: true
    full_test_required: true
    limited_rollout_required: true

rejection:
  reject_quality_reduction: true
  reject_security_reduction: true
  reject_unbounded_automation: true
  reject_unverified_rule_activation: true
  reject_missing_rollback: true
  reject_single_case_generalization: true
```

------------------------------------------------------------

# 9. ROLLOUT POLICY

`rollout_policy.yaml`은 다음 구조를 따른다.

```yaml
schema_version: "1.0"

rollout:
  patch:
    sandbox_required: true
    sample_size:
    observation_runs: 1

  minor:
    sandbox_required: true
    sample_percentage: 10
    minimum_items: 3
    maximum_items: 10
    observation_runs: 2

  major:
    sandbox_required: true
    sample_percentage: 5
    minimum_items: 3
    maximum_items: 5
    observation_runs: 3

stop_conditions:
  critical_issue_count: 1
  major_issue_count: 1
  quality_score_drop: 2
  workflow_failure_rate_increase_percent: 10
  publication_failure_rate_increase_percent: 10
  security_regression: true
  duplicate_output_incident: true
  policy_violation: true

success_conditions:
  no_critical_issues: true
  no_major_issues: true
  no_quality_regression: true
  no_security_regression: true
  no_schema_corruption: true
  no_duplicate_publication: true
```

------------------------------------------------------------

# 10. ROLLBACK POLICY

`rollback_policy.yaml`은 다음 구조를 따른다 (3.6, STEP 26, "20. CHANGE FREEZE POLICY" 참조).

```yaml
schema_version: "1.0"

rollback:
  require_snapshot_before_change: true
  require_rollback_plan_for_every_changeset: true
  require_wf10_regression_after_rollback: true
  automatic_rollback: false

triggers:
  critical_security_issue: true
  policy_gate_bypass: true
  clear_quality_score_decline: true
  workflow_failure_rate_increase: true
  registry_corruption: true
  schema_compatibility_failure: true
  wordpress_duplicate_publication: true
  auto_publish_permission_error: true
  data_corruption: true
  rollout_stop_condition_met: true

after_rollback:
  mark_release_resolved: false
  require_root_cause_reanalysis: true
  require_wf10_regression_test: true
```

------------------------------------------------------------

# 11. RELEASE POLICY

`release_policy.yaml`은 다음 구조를 따른다.

```yaml
schema_version: "1.0"

versioning:
  format: SEMVER
  current_version_source: 06_MEMORY/project_versions.json

release_requirements:
  proposal_approved: true
  changeset_validated: true
  wf10_passed: true
  rollout_passed: true
  rollback_plan_valid: true
  release_notes_required: true
  snapshot_required: true

release_types:
  PATCH:
    version_increment: patch

  MINOR:
    version_increment: minor

  MAJOR:
    version_increment: major

  CONSTITUTIONAL:
    version_increment: major

release_statuses:
  - DRAFT
  - READY
  - DEPLOYING
  - RELEASED
  - FAILED
  - ROLLED_BACK
  - SUPERSEDED
```

------------------------------------------------------------

# 12. REQUIRED OUTPUT

다음 파일을 생성하거나 갱신한다.

```text
17_GOVERNANCE/runtime/governance_state.json
17_GOVERNANCE/runtime/active_proposal.json
17_GOVERNANCE/runtime/active_changeset.json
17_GOVERNANCE/runtime/governance_lock.json
17_GOVERNANCE/runtime/release_state.json

17_GOVERNANCE/queue/proposal_queue.json
17_GOVERNANCE/queue/validation_queue.json
17_GOVERNANCE/queue/test_queue.json
17_GOVERNANCE/queue/approval_queue.json
17_GOVERNANCE/queue/rollout_queue.json
17_GOVERNANCE/queue/rollback_queue.json

17_GOVERNANCE/reports/GOVERNANCE_REPORT.md
17_GOVERNANCE/reports/CHANGE_CONTROL_REPORT.md
17_GOVERNANCE/reports/RELEASE_REPORT.md
17_GOVERNANCE/reports/ROLLBACK_REPORT.md
```

Memory:

```text
06_MEMORY/governance_registry.json
06_MEMORY/change_control_history.json
06_MEMORY/release_history.json
06_MEMORY/rollback_history.json
06_MEMORY/approved_change_registry.json
06_MEMORY/rejected_change_registry.json
```

(실제 경로: `06_MEMORY/GOVERNANCE_LIBRARY/` 하위, "0.1" 참조)

Log:

```text
08_LOG/WF-15/run_<timestamp>.json
08_LOG/WF-15/environment_validation.json
08_LOG/WF-15/events_<timestamp>.json
```

------------------------------------------------------------

# 13. GOVERNANCE STATES

Proposal 상태:

```text
NEW
VALIDATING
INSUFFICIENT_EVIDENCE
CONSTITUTION_REVIEW
IMPACT_REVIEW
RISK_REVIEW
APPROVED_FOR_TEST
TESTING
TEST_FAILED
TEST_PASSED
MANUAL_APPROVAL_REQUIRED
APPROVED_FOR_ROLLOUT
ROLLING_OUT
ROLLOUT_FAILED
PRODUCTION_VALIDATED
RELEASED
REJECTED
DEFERRED
ROLLED_BACK
ARCHIVED
```

Change Set 상태:

```text
DRAFT
SNAPSHOT_CREATED
SANDBOX_APPLIED
VALIDATING
VALIDATED
TESTING
TEST_PASSED
TEST_FAILED
ROLLOUT_READY
ROLLOUT_ACTIVE
RELEASE_READY
RELEASED
FAILED
ROLLED_BACK
```

Release 상태:

```text
DRAFT
READY
DEPLOYING
RELEASED
FAILED
ROLLED_BACK
SUPERSEDED
```

------------------------------------------------------------

# 14. MASTER WORKFLOW

```text
STEP 01  환경 및 Governance 자산 검증
STEP 02  Change Proposal 수집
STEP 03  Proposal 정규화
STEP 04  중복 Proposal 통합
STEP 05  Proposal 무결성 검사
STEP 06  근거와 신뢰도 평가
STEP 07  Constitution 충돌 검사
STEP 08  변경 대상 및 범위 분석
STEP 09  영향도 분석
STEP 10  위험도 분석
STEP 11  변경 등급 분류
STEP 12  우선순위 결정
STEP 13  승인 경로 결정
STEP 14  Change Set 생성
STEP 15  변경 전 Snapshot 생성
STEP 16  Sandbox 변경 적용
STEP 17  Static 및 Schema 검증
STEP 18  WF-10 테스트 실행
STEP 19  테스트 결과 판정
STEP 20  승인 또는 거절 판정
STEP 21  Limited Rollout
STEP 22  Production 결과 검증
STEP 23  Release 생성
STEP 24  정식 반영
STEP 25  Release 후 모니터링
STEP 26  Rollback 판정 및 실행
STEP 27  WF-08·WF-11·WF-12 전달
STEP 28  Registry·History·Report 갱신
```

## STEP 01. ENVIRONMENT VALIDATION

다음을 검사한다.

```yaml
environment_validation:
  project_root_valid:
  constitution_valid:
  workflow_files_valid:
  change_proposal_sources_valid:
  project_version_valid:
  governance_directory_valid:
  configs_valid:
  snapshot_directory_writable:
  sandbox_directory_writable:
  wf10_available:
  rollback_capability_valid:
  secret_exposure_absent:
  status:
  blocking_issues: []
  warnings: []
```

검증 결과: `08_LOG/WF-15/environment_validation.json`

다음 문제는 실행을 차단한다: Project Constitution 누락 / Project Version 손상 / 변경 대상 파일 접근 불가 / Snapshot 저장 불가 / WF-10 실행 불가 / Rollback 경로 생성 불가 / Secret 노출 / 운영과 테스트 경로 혼합 / 활성 Release 충돌

## STEP 02. CHANGE PROPOSAL COLLECTION

다음 출처에서 제안을 수집한다: WF-08 Learning Proposals / WF-10 Test Issues / WF-11 Incidents / WF-12 Performance Findings / WF-13 Remediation Findings / WF-14 Experiment Findings / 수동 Change Proposal

표준 구조:

```yaml
change_proposal:
  proposal_id:
  source_workflow:
  source_file:
  created_at:
  type:
  target:
  current_state:
  observed_problem:
  evidence: []
  proposed_change:
  expected_benefit:
  possible_risks: []
  validation_method:
  rollback_plan:
  status:
```

## STEP 03. PROPOSAL NORMALIZATION

모든 제안을 다음 표준 Schema로 변환한다.

```yaml
normalized_proposal:
  proposal_id:
  source:
  domain:
  change_level_candidate:
  target_files: []
  target_objects: []
  problem:
  evidence: []
  occurrence_count:
  affected_content_ids: []
  affected_workflows: []
  expected_benefit:
  risks: []
  alternatives: []
  test_requirements: []
  rollout_requirements:
  rollback_requirements:
```

## STEP 04. DUPLICATE PROPOSAL CONSOLIDATION

다음 항목이 같은 경우 Proposal을 통합한다: 동일 대상 / 동일 문제 / 동일 Root Cause / 동일 변경 방향 / 동일 영향 범위

통합 구조:

```yaml
proposal_group:
  group_id:
  primary_proposal_id:
  merged_proposal_ids: []
  shared_target:
  shared_problem:
  shared_root_cause:
  combined_evidence: []
  occurrence_count:
```

같은 대상이라도 목적과 위험이 다르면 별도로 유지한다.

## STEP 05. PROPOSAL INTEGRITY VALIDATION

다음을 검사한다.

```yaml
proposal_integrity:
  proposal_id:
  target_exists:
  target_version_known:
  problem_defined:
  proposed_change_defined:
  evidence_present:
  expected_benefit_defined:
  risks_defined:
  validation_plan_present:
  rollback_plan_present:
  source_traceable:
  result:
```

필수 항목이 누락되면: `INSUFFICIENT_EVIDENCE` | `INVALID_PROPOSAL`

## STEP 06. EVIDENCE AND CONFIDENCE REVIEW

증거를 평가한다.

```yaml
evidence_review:
  proposal_id:
  evidence_sources: []
  distinct_content_count:
  distinct_run_count:
  occurrence_count:
  official_evidence:
  observed_evidence:
  inferred_evidence:
  contradictory_evidence: []
  alternative_causes: []
  confidence:
  sufficient_for_change:
```

`confidence`: `VERY_HIGH` | `HIGH` | `MEDIUM` | `LOW` | `INSUFFICIENT`

MINOR 이상 변경은 원칙적으로 `HIGH` 이상을 요구한다.

## STEP 07. CONSTITUTION COMPATIBILITY REVIEW

변경이 Project Constitution과 충돌하는지 검사한다.

```yaml
constitution_review:
  proposal_id:
  affected_principles: []
  direct_conflict:
  indirect_conflict:
  quality_conflict:
  security_conflict:
  workflow_policy_conflict:
  memory_policy_conflict:
  publication_policy_conflict:
  result:
```

`result`: `COMPATIBLE` | `COMPATIBLE_WITH_CONDITIONS` | `CONSTITUTION_AMENDMENT_REQUIRED` | `REJECTED_CONSTITUTION_CONFLICT`

Constitution Amendment는 자동 수행하지 않는다.

## STEP 08. CHANGE SCOPE ANALYSIS

변경 대상을 구체화한다.

```yaml
change_scope:
  proposal_id:
  domain:
  target_files: []
  target_objects: []
  affected_workflows: []
  affected_schemas: []
  affected_configs: []
  affected_registries: []
  affected_runtime: []
  affected_outputs: []
  affected_publication_behavior:
  sitewide:
```

변경 범위를 최소화한다.

## STEP 09. IMPACT ANALYSIS

다음 영향을 분석한다.

```yaml
impact_analysis:
  proposal_id:
  upstream_workflows: []
  downstream_workflows: []
  data_migration_required:
  registry_migration_required:
  output_compatibility:
  backward_compatibility:
  publication_impact:
  wordpress_impact:
  security_impact:
  performance_impact:
  operations_impact:
  testing_impact:
  user_visible_impact:
  impact_level:
```

`impact_level`: `LOW` | `MEDIUM` | `HIGH` | `CRITICAL`

## STEP 10. RISK ASSESSMENT

```yaml
risk_assessment:
  proposal_id:
  regression_risk:
  data_loss_risk:
  publication_risk:
  security_risk:
  policy_risk:
  quality_risk:
  compatibility_risk:
  operational_risk:
  rollback_complexity:
  reversibility:
  overall_risk:
```

`overall_risk`: `LOW` | `MEDIUM` | `HIGH` | `CRITICAL`

다음은 자동 승인할 수 없다: HIGH 이상 위험 / Reversibility LOW / Security 또는 Publication 권한 변경 / Data Migration 필요 / Project Constitution 영향 / Core Workflow 구조 변경

## STEP 11. CHANGE LEVEL CLASSIFICATION

다음 기준으로 분류한다.

```yaml
change_classification:
  proposal_id:
  domain:
  level:
  reasoning:
  requires_manual_approval:
  requires_wf10_scope:
  requires_limited_rollout:
  version_increment:
```

`level`: `PATCH` | `MINOR` | `MAJOR` | `CONSTITUTIONAL`

## STEP 12. PRIORITY SCORING

```yaml
change_priority:
  proposal_id:
  severity_score:
  frequency_score:
  evidence_score:
  operational_impact_score:
  security_score:
  quality_score:
  reversibility_score:
  effort_score:
  final_score:
  priority:
```

`priority`: `P0` | `P1` | `P2` | `P3` | `DEFER` | `REJECT`

P0 예: Secret 노출 / 무단 자동 게시 / Registry 손상 / 품질 Gate 우회 / 대량 중복 게시

## STEP 13. APPROVAL ROUTING

```yaml
approval_routing:
  proposal_id:
  change_level:
  automatic_approval_allowed:
  manual_approval_required:
  constitution_amendment_required:
  security_review_required:
  publication_review_required:
  test_scope:
  rollout_required:
  current_status:
```

자동 승인 가능 조건: `PATCH` + `LOW` 위험 + `HIGH` 이상 신뢰도 + Constitution 충돌 없음 + Rollback 가능

## STEP 14. CHANGESET CREATION

Change Set ID 형식: `CHG-YYYYMMDD-0001`

저장 위치: `17_GOVERNANCE/changesets/draft/CHG-<id>.json`

```yaml
schema_version: "1.0"

changeset:
  changeset_id:
  proposal_ids: []
  domain:
  level:
  status:
  created_at:

  target_version:
  current_project_version:

  target_files: []
  target_objects: []

  changes:
    - change_item_id:
      target_file:
      target_object:
      previous_value:
      proposed_value:
      change_reason:
      validation_method:

  migrations: []
  tests: []
  rollout_plan:
  rollback_plan:
  approval_requirements:
```

## STEP 15. PRE-CHANGE SNAPSHOT

변경 전 다음을 Snapshot으로 저장한다: 변경 대상 파일 / 관련 Workflow 정의 / 관련 Schema / 관련 Registry / 관련 Config / Project Version / WF-10 Baseline / 현재 Hash

저장 위치: `17_GOVERNANCE/snapshots/pre_change/CHG-<id>/`

```yaml
snapshot:
  changeset_id:
  created_at:
  project_version:
  files: []
  hashes: []
  registry_versions: []
  config_versions: []
  baseline_test_run:
```

## STEP 16. SANDBOX IMPLEMENTATION

운영 파일을 직접 수정하지 않는다.

Sandbox 위치: `17_GOVERNANCE/changesets/sandbox/CHG-<id>/`

Sandbox에 변경본을 생성한다.

검사 항목: 파일 파싱 / Schema 일치 / 참조 경로 / ID 충돌 / Handoff 호환성 / Dependency 변화 / Config 기본값 / Secret 노출 / Version 정보

## STEP 17. STATIC AND SCHEMA VALIDATION

```yaml
static_validation:
  changeset_id:
  files_parseable:
  schemas_valid:
  ids_valid:
  references_valid:
  paths_valid:
  dependencies_valid:
  handoffs_valid:
  configs_safe:
  secrets_absent:
  backward_compatibility:
  result:
```

Static Validation 실패 시 WF-10으로 진행하지 않는다.

## STEP 18. WF-10 TEST EXECUTION

변경 수준에 따라 테스트를 수행한다.

**PATCH**

```text
WF-10 빠른 테스트
+ 관련 Workflow Unit Test
```

**MINOR**

```text
WF-10 특정 Workflow 테스트
+ Integration Test
+ Regression Test
```

**MAJOR**

```text
WF-10 전체 테스트
+ End-to-End Test
+ Security Test
+ Recovery Test
+ Regression Test
```

**Publication 또는 WordPress 변경**

```text
WF-10 WordPress 안전 테스트
```

테스트 결과를 Change Set에 연결한다.

## STEP 19. TEST RESULT DECISION

```yaml
test_decision:
  changeset_id:
  test_run_id:
  acceptance_status:
  critical_failures:
  major_failures:
  moderate_failures:
  regressions: []
  security_status:
  wordpress_status:
  decision:
```

`decision`: `PASS` | `PASS_WITH_WARNINGS` | `FAIL` | `BLOCKED`

Critical 또는 Major 문제가 있으면 승인하지 않는다.

## STEP 20. APPROVAL DECISION

```yaml
approval_decision:
  proposal_id:
  changeset_id:
  evidence_sufficient:
  constitution_compatible:
  risk_acceptable:
  tests_passed:
  rollback_valid:
  rollout_plan_valid:
  manual_approval_status:
  decision:
  conditions: []
```

`decision`: `APPROVED_FOR_ROLLOUT` | `APPROVED_WITH_CONDITIONS` | `MANUAL_APPROVAL_REQUIRED` | `DEFERRED` | `REJECTED`

## STEP 21. LIMITED ROLLOUT

MINOR 이상 변경은 제한 배포를 수행한다.

Rollout 대상: 제한된 키워드 / 제한된 콘텐츠 수 / 특정 Workflow 실행 / Test WordPress 또는 Draft Only / 운영 전체가 아닌 일부 Batch

```yaml
limited_rollout:
  rollout_id:
  changeset_id:
  target_scope:
  content_ids: []
  workflow_ids: []
  batch_ids: []
  start_at:
  status:
  monitoring_metrics: []
  stop_conditions: []
  success_conditions: []
```

## STEP 22. PRODUCTION VALIDATION

Limited Rollout 결과를 검증한다.

```yaml
production_validation:
  rollout_id:
  workflow_success_rate:
  quality_score_change:
  critical_issues:
  major_issues:
  publication_failures:
  duplicate_outputs:
  registry_errors:
  security_incidents:
  performance_regressions:
  validation_status:
```

`validation_status`: `PASSED` | `PASSED_WITH_WARNINGS` | `FAILED` | `INCONCLUSIVE`

## STEP 23. RELEASE CREATION

Release ID 형식: `REL-YYYYMMDD-0001`

저장 위치: `17_GOVERNANCE/releases/pending/REL-<id>.json`

```yaml
release:
  release_id:
  changeset_id:
  project_version:
  previous_version:
  release_type:
  status:
  created_at:

  changes:
    rules: []
    patterns: []
    templates: []
    content_dna: []
    decision_tree: []
    workflows: []
    schemas: []
    configs: []
    policies: []

  test_results:
  rollout_results:
  rollback_plan:
  release_notes:
```

## STEP 24. PRODUCTION RELEASE

정식 반영 전 다음을 확인한다.

```yaml
release_gate:
  proposal_approved:
  changeset_validated:
  wf10_passed:
  rollout_passed:
  rollback_ready:
  release_notes_ready:
  snapshot_ready:
  version_ready:
  lock_available:
```

조건을 모두 충족한 경우에만 변경본을 정식 경로에 반영한다.

기존 파일은 Archive 후 교체한다.

정식 반영 위치는 기존 프로젝트 구조를 유지한다.

## STEP 25. POST-RELEASE MONITORING

Release 후 다음을 관찰한다: Workflow 실패율 / 품질 통과율 / 평균 품질 점수 / Source 오류율 / Registry 오류 / Publication 실패 / WordPress 중복 / Security Incident / Loop 발생 / Rollback 조건

모니터링 구조:

```yaml
post_release_monitoring:
  release_id:
  monitoring_period:
  executions_observed:
  affected_content_count:
  workflow_failures:
  quality_regressions:
  publication_failures:
  security_incidents:
  rollback_triggers:
  status:
```

## STEP 26. ROLLBACK DECISION AND EXECUTION

다음 조건에서 Rollback을 실행하거나 Queue에 넣는다: Critical 보안 문제 / 정책 Gate 우회 / 품질 점수 명확한 하락 / Workflow 실패율 증가 / Registry 손상 / Schema 호환성 실패 / WordPress 중복 게시 / 자동 공개 권한 오류 / 데이터 손상 / Rollback Trigger 충족

```yaml
rollback:
  rollback_id:
  release_id:
  changeset_id:
  reason:
  trigger:
  snapshot_path:
  affected_files: []
  previous_version:
  restored_version:
  validation_required:
  status:
```

Rollback 후 WF-10 Regression Test를 실행한다.

## STEP 27. WORKFLOW HANDOFF

Release 결과를 다음 Workflow에 전달한다.

**WF-08** — 변경 결과와 성과를 학습 데이터로 전달한다.

**WF-11** — 새 Project Version과 운영 가능 범위를 전달한다.

**WF-12** — 변경 후 성과 관찰이 필요한 경우 전달한다.

**WF-13** — 수정 또는 정책 문제와 연결된 변경이면 전달한다.

**WF-14** — Optimization Rule 변경이면 신규 Experiment에는 새 버전을 적용한다.

## STEP 28. MEMORY, LOG, AND REPORT UPDATE

### 28.1 Governance Registry

`06_MEMORY/governance_registry.json`

```yaml
proposals:
  - proposal_id:
    source:
    domain:
    level:
    priority:
    status:
    changeset_id:
    release_id:
    decision:
    created_at:
    updated_at:
```

### 28.2 Change Control History

`06_MEMORY/change_control_history.json` — Proposal, Test, Rollout, Release, Rollback 이력을 저장한다.

### 28.3 Release History

`06_MEMORY/release_history.json`

```yaml
releases:
  - release_id:
    project_version:
    previous_version:
    changeset_id:
    release_type:
    status:
    released_at:
    rollback_available:
    release_report:
```

### 28.4 실행 로그

`08_LOG/WF-15/run_<timestamp>.json`

```yaml
workflow: WF-15
started_at:
completed_at:

proposals:
  collected:
  normalized:
  merged:
  invalid:
  insufficient_evidence:
  approved_for_test:
  rejected:
  deferred:

changesets:
  created:
  sandboxed:
  validated:
  test_passed:
  test_failed:
  rollout_started:
  rollout_passed:
  rollout_failed:

releases:
  created:
  released:
  failed:
  rolled_back:

tests:
  quick:
  targeted:
  full:
  security:
  wordpress:
  regression:

created_files: []
updated_files: []
archived_files: []
errors: []
```

------------------------------------------------------------

# 15. CHANGE PROPOSAL STANDARD SCHEMA

```yaml
schema_version: "1.0"
workflow: WF-15

proposal_id:
source_workflow:
source_reference:
status:
priority:
created_at:
updated_at:

change:
  domain:
  target:
  target_files: []
  target_objects: []
  proposed_change:
  expected_benefit:

problem:
  description:
  root_cause:
  occurrence_count:
  affected_content_ids: []
  affected_workflows: []

evidence:
  sources: []
  confidence:
  contradictory_evidence: []
  alternative_causes: []

classification:
  level:
  impact:
  risk:
  reversibility:
  constitution_compatibility:

requirements:
  manual_approval:
  test_scope:
  rollout_required:
  migration_required:
  rollback_required:

decision:
  status:
  reason:
  conditions: []

links:
  changeset_id:
  test_run_id:
  rollout_id:
  release_id:
  rollback_id:
```

------------------------------------------------------------

# 16. RELEASE REPORT FORMAT

```markdown
# Content OS Release Report

## 기본 정보

- Release ID:
- Change Set ID:
- Proposal ID:
- Previous Version:
- New Version:
- Release Type:
- Status:
- Released At:

## 변경 목적

## 변경 근거

## 변경 대상

### Rule
### Pattern
### Template
### Content DNA
### Decision Tree
### Workflow
### Schema
### Configuration
### Policy

## Constitution 검토

## 영향도 분석

## 위험도 분석

## Sandbox 검증

## WF-10 결과

- Test Run ID:
- Acceptance:
- Critical:
- Major:
- Security:
- WordPress:
- Regression:

## Limited Rollout 결과

## 정식 반영 파일

## Archive

## Rollback 계획

## Release 후 모니터링

## 발생 문제

## 최종 상태
```

------------------------------------------------------------

# 17. GOVERNANCE REPORT FORMAT

```markdown
# Content OS Governance Report

## 실행 정보

- Governance Run ID:
- Project Version:
- 시작:
- 종료:
- 전체 상태:

## Change Proposal

- 신규:
- 통합:
- 근거 부족:
- 승인:
- 보류:
- 거절:

## Change Level

- PATCH:
- MINOR:
- MAJOR:
- CONSTITUTIONAL:

## Domain

- Rule:
- Pattern:
- Template:
- Content DNA:
- Workflow:
- Schema:
- Quality:
- Security:
- Publication:
- Operations:

## 테스트

## Limited Rollout

## Release

## Rollback

## 열린 수동 승인

## Constitution Amendment 필요 항목

## 운영 차단 항목

## 생성·수정 파일
```

------------------------------------------------------------

# 18. COMMAND BEHAVIOR

**전체 실행**

```text
WF-15 전체 실행
```

모든 미처리 Change Proposal을 수집하고 검토한다.

**Proposal 수집**

```text
WF-15 Proposal 수집
```

변경하지 않고 신규 Proposal만 정규화한다.

**Proposal 검토**

```text
WF-15 Proposal 검토: CP-0001
```

해당 Proposal의 근거, 영향, 위험, 승인 경로를 검토한다.

**Change Set 생성**

```text
WF-15 Change Set 생성: CP-0001
```

승인 가능한 Proposal의 Change Set을 생성한다.

**Sandbox 적용**

```text
WF-15 Sandbox 적용: CHG-20260803-0001
```

운영 파일을 변경하지 않고 Sandbox 변경본을 만든다.

**테스트 실행**

```text
WF-15 테스트: CHG-20260803-0001
```

변경 수준에 맞는 WF-10 테스트를 실행한다.

**Limited Rollout**

```text
WF-15 제한 배포: CHG-20260803-0001
```

검증된 제한 범위에만 적용한다.

**Release 생성**

```text
WF-15 Release 생성: CHG-20260803-0001
```

정식 Release Package를 생성한다.

**Release 적용**

```text
WF-15 Release 적용: REL-20260803-0001
```

모든 Gate를 통과한 Release만 적용한다.

**Rollback**

```text
WF-15 Rollback: REL-20260803-0001
```

검증된 Snapshot을 기준으로 이전 버전을 복원한다.

**Project Version**

```text
WF-15 버전 상태
```

현재 버전, Pending Release, 최근 Rollback을 출력한다.

**수동 승인 목록**

```text
WF-15 수동 승인 목록
```

자동 승인할 수 없는 변경만 출력한다.

**거절 목록**

```text
WF-15 거절 목록
```

거절된 Proposal과 사유를 출력한다.

**상태 확인**

```text
WF-15 상태
```

파일을 변경하지 않고 Governance 상태만 출력한다.

------------------------------------------------------------

# 19. IDEMPOTENCY AND VERSION CONTROL

같은 Proposal, 같은 대상 버전, 같은 증거로 재실행할 경우 중복 Proposal과 Change Set을 생성하지 않는다.

비교 항목: Proposal Source / Target / Problem / Root Cause / Proposed Change / Evidence Hash / Target Version / Existing Proposal Status / Existing Change Set Status

변경이 없으면: `UNCHANGED`

새 증거가 추가되면 기존 Proposal을 갱신한다.

같은 변경이 이미 Released 상태라면 새 Proposal을 만들지 않는다.

------------------------------------------------------------

# 20. MANUAL APPROVAL POLICY

다음 변경은 수동 승인 없이 Release하지 않는다: Project Constitution / Content DNA 핵심 변경 / 품질 통과 점수 변경 / 출처 기준 변경 / 보안 정책 변경 / 자동 게시 활성화 / Delete 권한 활성화 / WordPress 권한 확대 / Workflow Major 변경 / Registry Major Schema 변경 / 대규모 데이터 Migration / 고위험 콘텐츠 기준 변경

WF-15는 수동 승인 결과를 임의 생성하지 않는다.

수동 승인 결과 입력 구조:

```yaml
manual_approval:
  approval_id:
  proposal_id:
  changeset_id:
  decision:
  approved_scope:
  conditions: []
  reviewer_notes:
  decided_at:
```

`decision`: `APPROVED` | `APPROVED_WITH_CONDITIONS` | `REJECTED` | `DEFERRED`

------------------------------------------------------------

# 21. CHANGE FREEZE POLICY

다음 상황에서는 신규 Release를 중단한다: Critical Incident 진행 중 / Production Registry 손상 / WF-10 REJECTED / Security Test 실패 / WordPress Safety Test 실패 / 활성 Rollback 진행 중 / Project Version 충돌 / 자동 게시 권한 이상 / 대량 품질 회귀

상태: `CHANGE_FREEZE_ACTIVE`

PATCH 수준 보안 수정은 예외적으로 허용할 수 있다.

------------------------------------------------------------

# 22. SECURITY POLICY

다음을 준수한다.

- Secret 값을 Proposal에 저장하지 않는다.
- Config 변경 시 환경변수 이름만 기록한다.
- WordPress 비밀번호를 Changeset에 포함하지 않는다.
- API Token을 Release Report에 포함하지 않는다.
- Security Policy 완화는 자동 승인하지 않는다.
- 자동 게시 권한 확대는 수동 승인과 Security Test를 요구한다.
- Delete 권한을 기본적으로 금지한다.
- Snapshot에 Secret이 포함되지 않도록 검사한다.
- Release Archive에서 Credential을 제거한다.
- 테스트 및 운영 데이터를 구분한다.

------------------------------------------------------------

# 23. ABSOLUTE PROHIBITIONS

다음을 절대 수행하지 않는다.

- Proposal 없이 핵심 파일 변경
- Constitution 우회
- 품질 기준 하향
- 보안 기준 완화
- 출처 기준 완화
- 자동 Publish 기본 활성화
- Delete 권한 자동 활성화
- WF-10 검증 생략
- Snapshot 없는 변경
- Rollback 계획 없는 변경
- 단일 사례 전체 Rule 일반화
- 근거 부족 Proposal 승인
- Critical Regression 무시
- 테스트 실패 Release
- Limited Rollout 실패 후 전체 배포
- 운영 파일 직접 무검증 수정
- 동일 Release 중복 적용
- Project Version 임의 변경
- Release History 삭제
- Rollback History 삭제
- Secret 출력
- Credential 저장
- 수동 승인 결과 임의 생성
- 사용자에게 선택 요구
- 사용자에게 다음 단계 제안

------------------------------------------------------------

# 24. SUCCESS CONDITION

WF-15는 다음 조건을 모두 충족해야 완료된다.

1. 모든 변경 제안을 표준 형식으로 수집했다.
2. 중복 Proposal을 통합했다.
3. Proposal 무결성과 근거를 검증했다.
4. Project Constitution 충돌 여부를 확인했다.
5. 변경 범위와 영향을 분석했다.
6. 품질, 보안, 운영, 게시 위험을 평가했다.
7. 변경을 PATCH, MINOR, MAJOR, CONSTITUTIONAL로 분류했다.
8. 자동 승인과 수동 승인 대상을 구분했다.
9. 승인 가능한 Proposal에 Change Set을 생성했다.
10. 변경 전 Snapshot과 Rollback 계획을 생성했다.
11. Sandbox에서 변경을 적용했다.
12. Static 및 Schema 검증을 수행했다.
13. 변경 수준에 맞는 WF-10 테스트를 수행했다.
14. Critical 및 Major 테스트 실패를 통과시키지 않았다.
15. MINOR 이상 변경에 Limited Rollout을 수행했다.
16. Limited Rollout 결과를 검증했다.
17. 모든 Gate를 통과한 변경만 Release로 생성했다.
18. 정식 Release에 Project Version을 부여했다.
19. 기존 파일을 Archive 후 변경을 반영했다.
20. Release 후 운영 상태를 모니터링했다.
21. Rollback 조건 발생 시 안전하게 이전 버전을 복원했다.
22. Rollback 후 WF-10 회귀 검증을 수행했다.
23. Governance, Change, Release, Rollback Registry를 갱신했다.
24. WF-08, WF-11, WF-12에 변경 결과를 전달했다.
25. Secret과 인증정보를 어떤 산출물에도 포함하지 않았다.
26. 수동 승인 대상 변경을 자동 Release하지 않았다.
27. 프로젝트의 품질, 보안, 정책 기준을 낮추지 않았다.

------------------------------------------------------------

# 25. FINAL EXECUTION INSTRUCTION

지금부터 다음 순서로 작업한다.

1. 프로젝트 루트와 Project Constitution을 확인한다.
2. WF-01부터 WF-14까지의 현재 버전과 상태를 검증한다.
3. `17_GOVERNANCE` 폴더와 안전한 Governance 설정을 구성한다.
4. WF-08, WF-10, WF-11, WF-12, WF-13, WF-14에서 생성된 변경 제안을 수집한다.
5. 모든 Proposal을 표준 Schema로 정규화한다.
6. 동일한 Root Cause와 변경 방향을 가진 Proposal을 통합한다.
7. Proposal의 대상, 근거, 변경 내용, 기대 효과, 위험, 검증 계획을 검사한다.
8. 근거의 신뢰도와 반복 발생 여부를 평가한다.
9. Project Constitution과의 충돌 여부를 검사한다.
10. 변경 대상 파일, Workflow, Schema, Config, Registry 범위를 계산한다.
11. 상위·하위 Workflow와 운영 환경에 미치는 영향을 분석한다.
12. 품질, 보안, 정책, 데이터, 게시, 호환성 위험을 평가한다.
13. 변경을 PATCH, MINOR, MAJOR, CONSTITUTIONAL로 분류한다.
14. 변경 우선순위와 승인 경로를 결정한다.
15. 승인 가능한 Proposal에 Change Set을 생성한다.
16. 변경 전 Snapshot과 Rollback 계획을 생성한다.
17. 운영 파일이 아닌 Sandbox에 변경을 적용한다.
18. 파일, Schema, ID, 경로, Handoff, Dependency를 검증한다.
19. 변경 수준에 맞는 WF-10 테스트를 실행한다.
20. 테스트 결과를 근거로 승인, 보류, 거절을 결정한다.
21. MINOR 이상 변경은 제한된 범위에서 Rollout한다.
22. Rollout의 품질, 실패율, 게시, 보안, Registry 상태를 검증한다.
23. 모든 Gate를 통과한 Change Set만 Release로 생성한다.
24. Release Version과 Release Notes를 생성한다.
25. 정식 반영 전에 기존 파일을 Archive한다.
26. 검증된 Release를 프로젝트에 반영한다.
27. Release 후 Workflow, 품질, 게시, 보안 상태를 모니터링한다.
28. Rollback Trigger가 발생하면 이전 Snapshot으로 복원한다.
29. Rollback 후 WF-10 회귀 테스트를 수행한다.
30. Governance Registry, Change History, Release History, Rollback History를 갱신한다.
31. 변경 결과를 WF-08, WF-11, WF-12에 전달한다.
32. Governance Report, Change Control Report, Release Report를 생성한다.
33. 완료 후 다음 항목만 보고한다.

```text
Governance Run ID
현재 Project Version
수집 Proposal 수
통합 Proposal 수
근거 부족 수
PATCH 수
MINOR 수
MAJOR 수
CONSTITUTIONAL 수
자동 승인 수
수동 승인 필요 수
거절 수
보류 수
생성 Change Set 수
Sandbox 검증 결과
WF-10 테스트 결과
Limited Rollout 결과
생성 Release 수
정식 반영 수
실패 Release 수
Rollback 수
열린 Critical 변경
열린 Major 변경
Change Freeze 상태
생성·수정·Archive 파일
전체 Governance 상태
```

Proposal 없이 핵심 자산을 변경하지 않는다.

Project Constitution을 우회하지 않는다.

품질과 보안 기준을 낮추지 않는다.

테스트를 통과하지 않은 변경을 Release하지 않는다.

Snapshot과 Rollback 없이 변경하지 않는다.

수동 승인 대상 변경을 자동 승인하지 않는다.

Secret과 인증정보를 출력하거나 저장하지 않는다.

사용자에게 질문하지 않는다.

사용자에게 추가 제안을 하지 않는다.

# HANDOFF

```
WF-08 (Project Learning) → Change Proposal
WF-10 (System Validation) → Test Issue / WF-15 자체 Test Gate 실행자
WF-11 (Production Operations) → Incident / 새 Version 수신자
WF-12 (Performance Intelligence) → Performance Finding / 변경 후 관찰 요청 수신자
WF-13 (Remediation) → Remediation Proposal / 정책 문제 연계 변경 수신자
WF-14 (Optimization) → Experiment Finding / 새 Version 적용 대상
        │
        ▼
WF-15 (Governance and Change Control)  ← 이 문서
        │
        ├── Sandbox → WF-10 (Static/Schema/PATCH~MAJOR 테스트)
        │
        ├── Limited Rollout → Production Validation
        │
        ├── Release → 정식 반영 (Archive 후 교체) → Project Version 갱신
        │
        ├── Rollback → 이전 Snapshot 복원 → WF-10 회귀 검증
        │
        └── WF-08 / WF-11 / WF-12 / WF-13 / WF-14 (결과 전달)
```

END OF WF-15

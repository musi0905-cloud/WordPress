# 17_GOVERNANCE/proposals

Change Proposal을 상태(STEP 13 GOVERNANCE STATES — Proposal 상태)에 따라 물리적으로 분리 저장한다.

| 하위 디렉토리 | 대응 Proposal 상태 |
|---|---|
| `new/` | `NEW`, `VALIDATING`, `INSUFFICIENT_EVIDENCE` |
| `validating/` | `CONSTITUTION_REVIEW`, `IMPACT_REVIEW`, `RISK_REVIEW` |
| `approved_for_test/` | `APPROVED_FOR_TEST` |
| `testing/` | `TESTING`, `TEST_FAILED`, `TEST_PASSED`, `MANUAL_APPROVAL_REQUIRED` |
| `approved_for_rollout/` | `APPROVED_FOR_ROLLOUT`, `ROLLING_OUT`, `ROLLOUT_FAILED`, `PRODUCTION_VALIDATED` |
| `released/` | `RELEASED` |
| `rejected/` | `REJECTED` |
| `deferred/` | `DEFERRED` |
| `archived/` | `ROLLED_BACK`, `ARCHIVED` |

같은 대상·문제·Root Cause·변경 방향·영향 범위를 가진 Proposal은 STEP 04에서 통합되며, 이미 `RELEASED`인 변경과 동일한 Proposal은 중복 생성하지 않는다(STEP 19 IDEMPOTENCY AND VERSION CONTROL).

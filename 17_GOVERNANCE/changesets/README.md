# 17_GOVERNANCE/changesets

Change Set을 상태(STEP 13 GOVERNANCE STATES — Change Set 상태)에 따라 물리적으로 분리 저장한다. Change Set 파일: `CHG-<id>.json` (형식: `CHG-YYYYMMDD-0001`).

| 하위 디렉토리 | 대응 Change Set 상태 |
|---|---|
| `draft/` | `DRAFT`, `SNAPSHOT_CREATED` |
| `sandbox/` | `SANDBOX_APPLIED`, `VALIDATING` |
| `validated/` | `VALIDATED`, `TESTING`, `TEST_PASSED`, `TEST_FAILED` |
| `rollout/` | `ROLLOUT_READY`, `ROLLOUT_ACTIVE` |
| `released/` | `RELEASE_READY`, `RELEASED` |
| `rolled_back/` | `FAILED`, `ROLLED_BACK` |

운영 파일은 `sandbox/`에서만 변경본이 만들어지며, 모든 검증(Static/Schema/WF-10)을 통과하기 전에는 정식 경로에 반영되지 않는다 (STEP 16 SANDBOX IMPLEMENTATION 참조).

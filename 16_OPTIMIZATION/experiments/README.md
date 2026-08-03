# 16_OPTIMIZATION/experiments

Optimization Experiment를 상태(STEP 13 EXPERIMENT STATES)에 따라 물리적으로 분리 저장한다. Experiment 파일: `EXP-<id>.json` (형식: `EXP-YYYYMMDD-0001`).

| 하위 디렉토리 | 대응 Experiment 상태 |
|---|---|
| `planned/` | `PLANNED` |
| `active/` | `IN_PROGRESS`, `VALIDATING`, `PUBLISHED` |
| `observing/` | `OBSERVING` |
| `completed/` | `COMPLETED` |
| `inconclusive/` | `INCONCLUSIVE`, `BLOCKED`, `FAILED` |
| `rolled_back/` | `ROLLED_BACK` |
| `archived/` | `ARCHIVED` |

각 Experiment는 하나의 주요 가설(Primary Hypothesis)만 시험하며, 완료 또는 관찰 중인 Experiment와 동일한 가설의 새 Experiment는 중복 생성하지 않는다 (STEP 18 IDEMPOTENCY AND VERSION CONTROL 참조).

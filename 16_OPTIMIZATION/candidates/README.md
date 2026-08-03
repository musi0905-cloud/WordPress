# 16_OPTIMIZATION/candidates

Optimization Candidate를 상태(STEP 13 CANDIDATE STATES)에 따라 물리적으로 분리 저장한다.

| 하위 디렉토리 | 대응 Candidate 상태 |
|---|---|
| `pending/` | `DETECTED`, `VALIDATING` |
| `accepted/` | `ACCEPTED` |
| `rejected/` | `REJECTED`, `INSUFFICIENT_DATA` |
| `observing/` | `WAITING` (관찰 기간 대기) |

`ROUTED_TO_WF13` 상태의 Candidate는 `15_REMEDIATION/queue/`로 전달된 뒤 이곳에서는 참조용으로만 보관한다.

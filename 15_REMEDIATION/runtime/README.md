# 15_REMEDIATION/runtime

| 파일 | 내용 |
|---|---|
| `remediation_state.json` | 마지막 Remediation Run 상태와 열린/활성/차단 Case 수 |
| `active_case.json` | 현재 진행 중인 Case와 진행 단계 |
| `remediation_lock.json` | 동시 실행 방지 Lock (`locked`, Heartbeat) |
| `current_validation.json` | 진행 중인 WF-06/WF-07/WF-10 재검증 상태 |

`remediation_lock.json`이 `locked: true`인 동안에는 새로운 WF-13 실행을 시작하지 않는다.

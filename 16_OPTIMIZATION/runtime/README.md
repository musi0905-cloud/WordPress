# 16_OPTIMIZATION/runtime

| 파일 | 내용 |
|---|---|
| `optimization_state.json` | 마지막 Optimization Run 상태와 활성/관찰 중 Experiment 수 |
| `active_experiment.json` | 현재 진행 중인 Experiment와 진행 단계 |
| `optimization_lock.json` | 동시 실행 방지 Lock (`locked`, Heartbeat) |
| `current_observation.json` | 진행 중인 사후 관찰 상태 |

`optimization_lock.json`이 `locked: true`인 동안에는 새로운 WF-14 실행을 시작하지 않는다.

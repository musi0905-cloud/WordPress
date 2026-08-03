# ORCHESTRATION LIBRARY

WF-09_MASTER_ORCHESTRATION이 채우는, 프로젝트 전체 실행(Run) 이력의 누적 저장소.

| 파일 | 내용 |
|---|---|
| `orchestration_registry.json` | Run 누적 인덱스 (run_id, mode, 시작/종료 시각, 상태, Workflow별 실행 결과, 콘텐츠 요약, 차단 이슈, 리포트 경로) |
| `execution_history.json` | Run 전체에 걸친 Workflow 실행 이벤트 이력 (WORKFLOW_STARTED/COMPLETED/FAILED/RETURNED 등) |
| `dependency_registry.json` | 실행 시점마다 계산된 의존성/실행 범위 이력 — `10_RUNTIME/dependency_graph.json`(현재 값)과 달리 과거 계산 결과의 기록 |
| `recovery_history.json` | 과거 Recovery 시도와 결과 이력 |

이 라이브러리는 `06_MEMORY/WORKFLOW_LIBRARY/`(WF-08이 채우는 Rule/Template/Workflow *성과* 분석)와 다른 목적을 가진다 — 이 라이브러리는 "언제 무엇이 실행되었는가"라는 오케스트레이션 실행 이력 자체를 기록하고, WORKFLOW_LIBRARY는 그 실행 결과에 대한 *학습된 평가*를 기록한다.

현재 진행 중이거나 가장 최근 Run의 실시간 상태는 여기가 아니라 `10_RUNTIME/`(특히 `workflow_state.json`, `current_run.json`)에서 관리된다. 이 라이브러리는 완료된 Run의 누적 이력이다.

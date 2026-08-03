# 10_RUNTIME

WF-09_MASTER_ORCHESTRATION의 실행 상태를 보관하는 디렉토리. 사람이 직접 편집하지 않는다.

| 파일 | 내용 |
|---|---|
| `dependency_graph.json` | WF-01~WF-08 의존성 그래프 (고정값, `02_WORKFLOW/WF-09_MASTER_ORCHESTRATION.md`의 "7. WORKFLOW DEPENDENCY GRAPH" 참조) |
| `workflow_state.json` | 프로젝트 전체 상태 스냅샷 — 각 Workflow의 현재 상태, 콘텐츠 처리 카운트, 차단 이슈 (STEP 22) |
| `lock.json` | 중복 실행 방지 Lock. 실행 중이 아니면 `locked: false` |
| `current_run.json` | 진행 중이거나 가장 최근에 완료된 Run의 상세 상태 |
| `workflow_queue.json` | 이번 Run에서 처리할 Workflow 대기열 (STEP 11) |
| `execution_request.json` | 이번 Run을 시작한 사용자 명령의 파싱 결과 (STEP 09~10) |
| `recovery_plan.json` | 실패/차단 항목에 대한 복구 계획 (STEP 21) |

`lock.json`이 `locked: true`인 상태로 오래 남아 있으면, WF-09는 이를 비정상 종료로 판단해 Recovery Log를 남기고 안전하게 해제한다 (STEP 07).

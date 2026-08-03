# 16_OPTIMIZATION/queue

| 파일 | 내용 |
|---|---|
| `optimization_queue.json` | 처리 대기 중인 Candidate/Experiment 목록 |
| `workflow_return_queue.json` | Experiment의 제한된 수정 작업을 되돌려보낼 Workflow(WF-03~WF-07 등)와 허용 범위 (STEP 15) |
| `validation_queue.json` | WF-06/WF-07 재검증 대기 항목 |
| `observation_queue.json` | WF-12 사후 관찰 요청 대기 항목 (STEP 19) — 관찰 기간 중 동일 콘텐츠의 새 Experiment 생성을 차단하는 기준이 된다 |

모든 Queue는 초기 상태에서 빈 배열로 시딩되며, WF-14 실행마다 갱신된다.

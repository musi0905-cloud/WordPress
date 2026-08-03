# 17_GOVERNANCE/queue

| 파일 | 내용 |
|---|---|
| `proposal_queue.json` | 처리 대기 중인 Change Proposal 목록 |
| `validation_queue.json` | Constitution/영향도/위험도 검토 대기 항목 |
| `test_queue.json` | WF-10 테스트 실행 대기 Change Set |
| `approval_queue.json` | 승인 판정 대기 항목 (자동/수동 승인 분기 포함) |
| `rollout_queue.json` | Limited Rollout 대기 Change Set |
| `rollback_queue.json` | Rollback 조건이 충족되어 실행 대기 중인 항목 |

모든 Queue는 초기 상태에서 빈 배열로 시딩되며, WF-15 실행마다 갱신된다.

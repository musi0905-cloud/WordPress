# 15_REMEDIATION/queue

| 파일 | 내용 |
|---|---|
| `remediation_queue.json` | 처리 대기 중인 Remediation Case/Action 목록 |
| `workflow_return_queue.json` | Case의 수정 작업을 되돌려보낼 Workflow(WF-03~WF-07 등)와 필요 입출력 (STEP 12) |
| `manual_review_queue.json` | 삭제/대규모 Merge/Redirect/Noindex/정책 페이지 실제 정보 등 사람 검토가 필요한 항목 (`19. MANUAL REVIEW POLICY`) |
| `validation_queue.json` | WF-06/WF-07/WF-10 재검증 대기 항목 |

모든 Queue는 초기 상태에서 빈 배열로 시딩되며, WF-13 실행마다 갱신된다.

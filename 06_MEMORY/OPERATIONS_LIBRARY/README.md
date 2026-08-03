# OPERATIONS LIBRARY

WF-11_PRODUCTION_OPERATIONS이 채우는, 실제 운영(Production) 이력의 누적 저장소.

| 파일 | 내용 |
|---|---|
| `operations_registry.json` | Operations Run 누적 인덱스 (operations_run_id, batch_ids, 처리된 키워드/승인 콘텐츠/WordPress Draft 수, Incident, 비용 상태, 리포트 경로) |
| `batch_history.json` | Batch 누적 이력 (batch_id, 시작/종료, 상태, 입력/완료/차단/실패/수동검토/WordPress Draft 수) |
| `operations_health.json` | 운영 건강도 평가 이력 (workflow/quality/source/publication/wordpress/cost/incident/queue/data_integrity/security 영역별 점수, 종합 등급) |
| `manual_review_registry.json` | 수동 검토로 넘어간 항목과 그 결과(APPROVED/REJECTED/RETURN_TO_WF04 등)의 누적 이력 — 살아있는 대기열은 `13_OPERATIONS/queue/manual_review_queue.json`, 이 파일은 그 처리 결과의 기록 |

이 라이브러리는 다른 라이브러리들과 다음과 같이 구분된다.

- `06_MEMORY/WORKFLOW_LIBRARY/`(WF-08) — 워크플로우/규칙 *성과*에 대한 학습된 평가
- `06_MEMORY/ORCHESTRATION_LIBRARY/`(WF-09) — 개별 실행(Run)의 오케스트레이션 이력
- `06_MEMORY/VALIDATION_LIBRARY/`(WF-10) — 시스템이 설계대로 동작하는지 검증한 이력
- `06_MEMORY/OPERATIONS_LIBRARY/`(WF-11) — 실제 운영 Batch/Incident/수동 검토의 이력

현재 진행 중인 운영 상태(활성 Batch, Lock, Queue)는 여기가 아니라 `13_OPERATIONS/runtime/`과 `13_OPERATIONS/queue/`에서 관리된다. 이 라이브러리는 완료된 운영의 누적 기록이다.

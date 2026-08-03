# PERFORMANCE LIBRARY

WF-12_PERFORMANCE_AND_APPROVAL_INTELLIGENCE가 채우는, 실제 운영 성과와 애드센스 승인 이력의 누적 저장소.

| 파일 | 내용 |
|---|---|
| `performance_registry.json` | Performance Run 누적 인덱스 (분석 기간, 데이터 소스, 게시/색인/검색 데이터 건수, 애드센스/수익 데이터 상태, 이상징후/Alert 건수) |
| `content_performance_history.json` | 콘텐츠별 성과 이력 (색인/검색/참여/수익, `02_WORKFLOW/WF-12_...md`의 "13. CONTENT PERFORMANCE SCHEMA") |
| `indexing_history.json` | 콘텐츠별 색인 상태 변화 이력 |
| `adsense_application_history.json` | 사이트별 애드센스 신청 Attempt 이력 (제출일/결과일/상태/공식 사유) |
| `approval_change_history.json` | 애드센스 재신청 Attempt 사이의 변경 사항 비교 이력 |
| `revenue_history.json` | 승인 후 실제 광고/수익 데이터 이력 (승인 전에는 값이 없음) |
| `performance_learning_queue.json` | WF-08에 전달할 Performance Learning Package — WF-08은 이 데이터를 근거로만 Rule/Template/Content DNA Candidate를 생성한다 |

이 라이브러리는 실제 값이 없으면 어떤 필드도 추정해서 채우지 않는다 (`data_status: UNAVAILABLE`). 애드센스 승인/거절은 공식 출처로 검증된 경우에만 확정되며, 상관관계는 기록하되 인과관계로 단정하지 않는다.

WF-12는 이 라이브러리를 근거로 Rule/Content DNA/Workflow를 직접 변경하지 않는다 — 변경 필요성은 오직 `performance_learning_queue.json`을 통해 WF-08에 제안으로만 전달된다.

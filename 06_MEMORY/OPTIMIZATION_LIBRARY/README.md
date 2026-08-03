# OPTIMIZATION LIBRARY

WF-14_CONTENT_OPTIMIZATION이 채우는, 게시 콘텐츠 성과 최적화 실험(Optimization Experiment)의 누적 저장소.

| 파일 | 내용 |
|---|---|
| `optimization_registry.json` | Experiment 누적 인덱스 (Experiment/Candidate/Content ID, 최적화 유형, 상태, 가설, Primary Metric, 결과, Snapshot 경로) |
| `optimization_history.json` | Candidate 탐지·승인·반려·라우팅 이력 |
| `experiment_history.json` | Experiment별 가설·변경·검증·관찰·결과·Rollback 이력 |
| `content_change_history.json` | 콘텐츠별 실제 변경 필드와 버전 이력 (Rollback 가능 여부 포함) |
| `optimization_learning_queue.json` | WF-08에 전달할 Optimization Learning Package — 성공/실패/판단 불가 패턴에서 도출된 Rule/Template/Workflow 변경 후보 |

이 라이브러리는 데이터가 부족한 콘텐츠를 성과 부진으로 기록하지 않으며, 검색 순위·CTR·수익 개선을 어떤 필드에도 보장 형태로 기록하지 않는다. 단일 Experiment 결과를 전체 Rule로 일반화하지 않고, 상관관계를 인과관계로 확정하지 않는다(`causal_claims_allowed: false`).

WF-14는 이 라이브러리를 근거로 Rule/Content DNA/Workflow/Constitution을 직접 변경하지 않는다 — 변경 필요성은 오직 `optimization_learning_queue.json`을 통해 WF-08에 제안으로만 전달된다.

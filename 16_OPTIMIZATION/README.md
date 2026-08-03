# 16_OPTIMIZATION

WF-14_CONTENT_OPTIMIZATION의 전용 디렉토리. 정상 게시·색인된 콘텐츠 중 충분한 관찰 데이터가 축적된 것만 대상으로, 검색 성과·클릭률·정보 최신성·내부링크·사용자 반응을 근거 기반 실험(Optimization Experiment)으로 개선한다. WF-13이 승인 거절·색인·사이트 구조 문제를 수정하는 복구 단계라면, WF-14는 이미 정상인 콘텐츠의 성과를 끌어올리는 운영 최적화 단계다.

| 하위 디렉토리 | 내용 |
|---|---|
| `config/` | Optimization/Candidate/Experiment/Observation/Rollback 정책 (모두 안전 기본값으로 시딩됨) |
| `intake/` | 원본 Candidate 입력 (성과 기반/최신성/수동/가져오기) |
| `candidates/` | Optimization Candidate 상태별 저장소 (`pending`/`accepted`/`rejected`/`observing`) |
| `experiments/` | Optimization Experiment 상태별 저장소 (`planned`/`active`/`observing`/`completed`/`inconclusive`/`rolled_back`/`archived`) |
| `queue/` | Optimization Queue, Workflow Return Queue, Validation Queue, Observation Queue |
| `snapshots/` | 변경 전/후/비교 Snapshot (`before`/`after`/`comparison`) |
| `runtime/` | 현재 Optimization 상태, 활성 Experiment, Lock, 진행 중인 관찰 |
| `reports/` | Optimization/Content Opportunity/Experiment Result 리포트, Experiment별 리포트 |

WF-14는 검색 순위·CTR·수익 상승을 보장하지 않으며, 데이터가 부족한 콘텐츠를 성과 부진으로 단정하지 않는다. 하나의 Experiment는 원칙적으로 하나의 주요 가설만 시험하며(제목/메타, 검색 의도 정렬, 최신성 갱신, 본문 구조, 내부링크 중 하나), 관찰 기간 중 동일 콘텐츠를 반복 수정하지 않는다. Slug와 게시 URL은 자동 변경하지 않고, 콘텐츠는 자동 삭제하지 않는다 — 삭제·Merge·Redirect·Noindex가 필요하면 WF-13에 Proposal만 전달한다.

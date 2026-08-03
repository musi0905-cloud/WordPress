# 08_LOG/WF-14

WF-14_CONTENT_OPTIMIZATION 실행 로그를 보관한다.

- `environment_validation.json` — STEP 01 환경/Registry/Snapshot 저장소/Remediation 충돌 검증 결과
- `run_<timestamp>.json` — Optimization Run 전체 실행 로그 (Candidate/Experiment 통계, 최적화 유형별 변경 건수, 검증 결과)
- `events_<timestamp>.json` — Experiment 생성/변경/Rollback 등 이벤트 상세 로그

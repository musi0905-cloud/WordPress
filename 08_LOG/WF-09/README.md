# 08_LOG/WF-09

WF-09_MASTER_ORCHESTRATION 실행 로그를 보관한다.

- `environment_validation.json` — STEP 01~05 프로젝트 루트/헌법/Workflow 파일/설정 검증 결과
- `run_<timestamp>.json` — Run 전체 실행 로그
- `workflow_events_<timestamp>.json` — 해당 Run 동안 발생한 모든 Workflow Event (RUN_CREATED, WORKFLOW_STARTED, WORKFLOW_COMPLETED, LOCK_RELEASED 등, "25. EVENT LOGGING" 참조)

# 11_REPORTS

WF-09_MASTER_ORCHESTRATION이 Run마다 생성하는 프로젝트 전체 실행 보고서를 보관한다. 개별 워크플로우의 실행 1회분 리포트(`05_OUTPUT/WF-0X_..._REPORT.md`)와 달리, 이 디렉토리의 리포트는 WF-01~WF-08 전체를 아우르는 마스터 레벨 요약이다.

- `MASTER_EXECUTION_REPORT.md` / `.json` — Run 전체 요약 (Workflow별 결과, 콘텐츠 처리 현황, 프로젝트 건강도, 최종 Handoff)
- `WORKFLOW_STATUS_REPORT.md` — 현재 각 Workflow의 상태 스냅샷 (`Content OS 상태` 명령 결과)
- `BLOCKING_ISSUES_REPORT.md` — 차단된 Workflow/콘텐츠와 원인 (`Content OS 차단 목록` 명령 결과)
- `RECOVERY_REPORT.md` — 복구 시도 결과 (`Content OS 복구` 명령 결과)

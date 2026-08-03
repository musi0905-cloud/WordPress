# 11_REPORTS

WF-09_MASTER_ORCHESTRATION이 Run마다 생성하는 프로젝트 전체 실행 보고서와, WF-16_FINAL_COMMAND_CENTER이 생성한 최종 통합 리포트를 보관한다. 개별 워크플로우의 실행 1회분 리포트(`05_OUTPUT/WF-0X_..._REPORT.md`)와 달리, 이 디렉토리의 리포트는 프로젝트 전체를 아우르는 마스터/최종 레벨 요약이다.

**WF-09 Run 리포트** (WF-01~WF-08 범위)

- `MASTER_EXECUTION_REPORT.md` / `.json` — Run 전체 요약 (Workflow별 결과, 콘텐츠 처리 현황, 프로젝트 건강도, 최종 Handoff)
- `WORKFLOW_STATUS_REPORT.md` — 현재 각 Workflow의 상태 스냅샷 (`Content OS 상태` 명령 결과)
- `BLOCKING_ISSUES_REPORT.md` — 차단된 Workflow/콘텐츠와 원인 (`Content OS 차단 목록` 명령 결과)
- `RECOVERY_REPORT.md` — 복구 시도 결과 (`Content OS 복구` 명령 결과)

**WF-16 최종 통합 리포트** (WF-01~WF-16 전체 범위, 1회 생성 후 재통합 시 갱신)

- `FINAL_SYSTEM_REPORT.md` — 통합 상태, Workflow별 상태, 지원 기능, 기본 안전 설정, 테스트 결과, 수동 설정 필요 항목
- `COMMAND_REFERENCE.md` — 전체 명령을 범주별로 정리한 참조 문서
- `PROJECT_HANDOVER.md` — 운영자 인수인계 문서 (실행 방법, 설정 방법, 보안 주의사항 등 22개 항목)
- `FINAL_PROJECT_STRUCTURE.md` — 최종 프로젝트 폴더 구조와 구조 검증 결과

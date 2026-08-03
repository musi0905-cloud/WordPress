# 01_SYSTEM

Content OS 운영에 필요한 시스템 레벨 설정과 공통 정의를 보관하는 디렉토리. WF-16_FINAL_COMMAND_CENTER가 채운다.

| 파일 | 내용 |
|---|---|
| `SYSTEM_PROMPT.md` | 실행 에이전트의 항상 지켜야 할 순서와 금지 사항 |
| `CORE_RULES.md` | WF-01~WF-16 전체에 적용되는 10개 절대 규칙 |
| `QUALITY_GATE.md` | 콘텐츠 게시 Gate(WF-06 92점 기준)와 시스템 Release Gate(WF-15) |
| `ERROR_POLICY.md` | 오류 심각도·유형·구조 표준 |
| `COMMAND_ROUTER.md` | 사용자 자연어 명령 → 실행 모드·Workflow 라우팅 표 전체 |
| `STATE_MACHINE.md` | Project 상태와 Content 상태 전환 원칙 |
| `SECURITY_POLICY.md` | Secret/Credential 미기록 원칙과 프로젝트 전역 보안 기준 |
| `HANDOFF_POLICY.md` | 모든 Workflow Handoff가 지켜야 할 공통 구조와 금지 사항 |

이 디렉토리는 WF-01 도입 시점부터 확장을 위해 예약되어 있었으며, WF-16이 최초로 실제 내용을 채웠다 (`02_WORKFLOW/WF-16_FINAL_COMMAND_CENTER.md` "5. FINAL REQUIRED OUTPUT" 참조).

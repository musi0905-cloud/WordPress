# 15_REMEDIATION/config

WF-13 실행 정책 설정.

| 파일 | 내용 |
|---|---|
| `remediation_config.yaml` | 실행 범위, 동시 Case 한도, Snapshot/검증 요구, 안전 기본값 (`02_WORKFLOW/WF-13_...md` "6") |
| `priority_policy.yaml` | 심각도/증거/범위 기반 우선순위 계산 가중치 (`7`) |
| `content_action_policy.yaml` | Action(KEEP/CORRECT/MERGE/REDIRECT/NOINDEX/ARCHIVE/DELETE_PROPOSAL)별 자동화 여부와 금지 사항 (`8`) |
| `reapplication_policy.yaml` | 애드센스 재신청 준비 조건과 상태값 (`9`) |
| `rollback_policy.yaml` | Rollback 트리거와 사후 처리 규칙 (`10`) |

모든 설정은 자동 삭제, 자동 재신청, 자동 공개를 기본적으로 차단한 안전 기본값으로 시딩되어 있다.

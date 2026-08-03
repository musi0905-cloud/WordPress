# 17_GOVERNANCE/config

WF-15 실행 정책 설정.

| 파일 | 내용 |
|---|---|
| `governance_config.yaml` | 실행 범위, 자동/수동 승인 대상, 테스트/Release 요구, 안전 기본값 (`02_WORKFLOW/WF-15_...md` "6") |
| `change_classification_policy.yaml` | PATCH/MINOR/MAJOR/CONSTITUTIONAL 등급 정의와 Domain 목록 (`7`) |
| `approval_policy.yaml` | 등급별 승인 임계값과 자동 거절 조건 (`8`) |
| `rollout_policy.yaml` | 제한 배포 범위와 중단/성공 조건 (`9`) |
| `rollback_policy.yaml` | Rollback 트리거와 사후 처리 규칙 (`10`) |
| `release_policy.yaml` | 버전 체계(SemVer)와 Release 요구사항 (`11`) |

모든 설정은 직접 운영 반영(`allow_direct_production_release: false`), 무제한 자동 승인, Delete/보안 기준 완화를 기본적으로 차단한 안전 기본값으로 시딩되어 있다.

# 16_OPTIMIZATION/config

WF-14 실행 정책 설정.

| 파일 | 내용 |
|---|---|
| `optimization_config.yaml` | 실행 범위, 동시 Experiment 한도, Snapshot/검증 요구, 안전 기본값 (`02_WORKFLOW/WF-14_...md` "6") |
| `candidate_policy.yaml` | Candidate 유형별 활성화 여부와 임계값, 제외 조건 (`7`) |
| `experiment_policy.yaml` | Experiment 필수 요구사항과 변경 범위 한도 (`8`) |
| `observation_policy.yaml` | 사후 관찰 최소/최대 기간과 보류 조건 (`9`, `19`) |
| `rollback_policy.yaml` | Rollback 트리거와 사후 처리 규칙 (`10`) |

모든 설정은 Slug 자동 변경, 콘텐츠 자동 삭제, 자동 공개를 기본적으로 차단한 안전 기본값으로 시딩되어 있다.

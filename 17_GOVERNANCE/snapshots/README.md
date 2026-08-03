# 17_GOVERNANCE/snapshots

변경 전/후 및 Release/Rollback 상태를 Change Set·Release 단위로 보존한다.

| 하위 디렉토리 | 내용 |
|---|---|
| `pre_change/` | 변경 전 Snapshot (`CHG-<id>/` 하위에 대상 파일/Schema/Registry/Config/Project Version/WF-10 Baseline 보존, STEP 15) |
| `post_change/` | Sandbox 적용 후 상태 |
| `release/` | 정식 반영 시점의 Snapshot (Archive 대상 포함) |
| `rollback/` | Rollback 실행 시 복원에 사용된 Snapshot 기록 |

`require_snapshot_before_change: true`(`governance_config.yaml`, `rollback_policy.yaml`)에 따라 Snapshot 없이는 어떤 Change Set도 Sandbox 단계를 진행하지 않는다.

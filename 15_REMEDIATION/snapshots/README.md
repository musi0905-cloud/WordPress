# 15_REMEDIATION/snapshots

수정 전/후 상태를 Case 단위로 보존한다 (STEP 10 BEFORE SNAPSHOT, STEP 21 BEFORE AND AFTER COMPARISON 참조).

| 하위 디렉토리 | 내용 |
|---|---|
| `before/` | 수정 전 Snapshot (`CASE-<id>/` 하위에 애드센스/사이트/색인/콘텐츠/Registry 상태 보존) |
| `after/` | 수정 후 Snapshot |
| `comparison/` | Before/After 비교 결과 |

`require_snapshot_before_change: true`(`rollback_policy.yaml`)에 따라 Snapshot 없이는 어떤 자동 수정도 수행하지 않는다.

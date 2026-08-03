# 16_OPTIMIZATION/snapshots

수정 전/후 상태를 Experiment 단위로 보존한다 (STEP 12 BEFORE SNAPSHOT, STEP 18 AFTER SNAPSHOT 참조).

| 하위 디렉토리 | 내용 |
|---|---|
| `before/` | 수정 전 Snapshot (`EXP-<id>/` 하위에 최종 Markdown/HTML/Metadata/출처/내부링크/Schema/WordPress Payload/성과 데이터 보존) |
| `after/` | 수정 후 Snapshot |
| `comparison/` | Before/After 변경 비교 결과 |

`require_before_snapshot: true`(`optimization_config.yaml`, `rollback_policy.yaml`)에 따라 Snapshot 없이는 어떤 Experiment 실행도 진행하지 않는다.

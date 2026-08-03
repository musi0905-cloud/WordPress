# 12_TEST/fixtures/corrupted

의도적으로 결함이 있는 Fixture. WF-10 STEP 21(Failure Injection Test)이 각 워크플로우가 이 결함을 올바르게 탐지·차단하는지 확인하는 데 사용한다. 정상 파이프라인에서는 절대 사용하지 않는다.

| 파일 | 결함 |
|---|---|
| `invalid.json` | 문법이 깨진 JSON |
| `missing_required_fields.yaml` | 필수 필드가 없는 YAML (Content Brief 형태) |
| `duplicate_keyword_ids.csv` | 동일한 `keyword_id`가 중복 |
| `nonexistent_rule_id.json` | Rule Library에 존재하지 않는 Rule ID 참조 |
| `broken_handoff.json` | `handoff.ready`가 boolean이 아니고 `next_workflow`/`status`가 누락됨 |
| `invalid_wordpress_status.json` | WordPress REST API가 허용하지 않는 status 값(`publish_now`) |

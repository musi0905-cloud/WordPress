# 12_TEST/fixtures/configs

테스트 전용 설정 사본. 운영 설정(`04_INPUT/publication_config.yaml`, `04_INPUT/wordpress_config.yaml`)을 그대로 재사용하되, WF-10 STEP 07(Configuration Safety Test)이 실행 중에는 반드시 아래 안전 기본값을 강제한다.

```yaml
publication:
  allow_auto_publish: false
  allow_scheduling: false

wordpress:
  default_status: draft
  allow_publish: false
  allow_delete: false

media:
  upload_enabled: false
```

WF-07/WF-10 WordPress 테스트는 이 폴더의 설정이 아니라 `12_TEST/fixtures/wordpress/`의 Mock 응답을 사용한다 — 실제 WordPress 엔드포인트를 호출하지 않는다.

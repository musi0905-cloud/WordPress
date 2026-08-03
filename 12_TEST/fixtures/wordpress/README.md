# 12_TEST/fixtures/wordpress

WordPress REST API Mock 응답. WF-07/WF-10의 WordPress 관련 테스트는 기본적으로 `MOCK` 모드를 사용하며, 이 폴더의 저장된 응답으로 실제 API 호출을 대체한다.

허용된 테스트 모드는 `MOCK` | `SANDBOX` | `DRAFT_ONLY` 뿐이다. `publish`/`future`/삭제 계열 응답은 여기에 두지 않는다 — WF-10은 실제 공개/삭제 동작 자체를 검증 대상에서 제외한다.

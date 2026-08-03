# 05_OUTPUT/publishing

WF-07_EXPORT_AND_PUBLISHING이 키워드별로 생성하는 게시 패키지를 보관한다.

각 키워드는 `KW-0001_<normalized-keyword>/` 하위 폴더를 가지며, 다음을 포함한다.

- `content_final.md` / `content_final.html` — WF-06 최종 원고 사본 (수정 없음)
- `content_wordpress.html` — WordPress 편집기 호환 변환본 (Semantic HTML 또는 Gutenberg Block Markup)
- `publication_payload.json` — 플랫폼 독립적 게시 페이로드
- `wordpress_payload.json` — WordPress REST API 페이로드 (기본 상태: `draft`)
- `schema.json` — 실제 콘텐츠와 일치하는 JSON-LD
- `metadata.json`, `sources.json`, `internal_links.json`, `media_manifest.json` — 최종 조립된 부속 자산
- `publication_checklist.md`, `publication_report.md` — 체크리스트와 실행 리포트
- `wordpress_result.json` — WordPress 연동이 활성화된 경우에만 생성 (Post ID, 상태, Preview/Public URL)

WordPress 인증정보(비밀번호, Application Password, API Token)는 이 폴더의 어떤 파일에도 기록되지 않는다 — 환경변수에서만 읽고 절대 출력하지 않는다.

`handoff.status`가 `PUBLISHING_BLOCKED`인 콘텐츠는 이 폴더에 부분 산출물만 남고 WF-08로 "게시 완료"로 전달되지 않는다.

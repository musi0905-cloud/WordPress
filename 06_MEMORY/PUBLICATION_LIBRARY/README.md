# PUBLICATION LIBRARY

WF-07_EXPORT_AND_PUBLISHING이 채우는, 게시 패키지와 실제 배포 상태의 누적 저장소.

| 파일 | 내용 |
|---|---|
| `publication_registry.json` | 모든 Publication의 요약 인덱스 (publication_id, keyword_id, mode, status, export/wordpress 경로, 자산/링크 상태, quality score) |
| `published_content_index.json` | 실제로 게시(또는 초안화)된 콘텐츠의 색인 — 내부링크 해석(STEP 06)과 카니벌라이제이션 검사(WF-04)가 참조하는 "이미 존재하는 콘텐츠" 목록 |
| `media_library.json` | 업로드되었거나 업로드가 필요한 미디어 자산의 상태 (WordPress Media ID/URL, ALT, 업로드 상태) |

키워드별 상세 게시 패키지(최종 원고 사본, Payload, Schema, 체크리스트, WordPress 결과)는 여기가 아니라 `05_OUTPUT/publishing/`에 저장된다. 이 라이브러리는 그 패키지들의 가벼운 인덱스이자, 실제 배포 상태(초안/예약/게시/동기화 실패)의 단일 진실 공급원이다.

이 라이브러리에는 WordPress 인증정보가 저장되지 않는다. 인증정보는 항상 환경변수 또는 Secret Store에서만 읽는다.

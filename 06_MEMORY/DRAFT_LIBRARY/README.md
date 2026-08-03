# DRAFT LIBRARY

WF-05_CONTENT_GENERATION이 채우는, 생성된 원고와 그 근거 출처의 누적 저장소.

| 파일 | 내용 |
|---|---|
| `draft_registry.json` | 모든 Draft의 요약 인덱스 (draft_id, architecture_id, keyword_id, title, slug, status, version, markdown/html/json/source_package 경로, quality_score) |
| `source_library.json` | 콘텐츠 전반에서 검증되어 재사용 가능한 출처 저장소 (source_id, publisher, source_type, freshness_status, reliability_score, supported_claims) — 동일 URL은 새 Source ID로 다시 만들지 않는다 |

키워드별 상세 원고(섹션 본문, 근거 연결, 내부링크/시각자료 마커, FAQ, 메타데이터 등)는 여기가 아니라 `05_OUTPUT/drafts/`에 저장된다. 이 라이브러리는 그 Draft들의 가벼운 인덱스와, Draft 간 재사용되는 출처 저장소다.

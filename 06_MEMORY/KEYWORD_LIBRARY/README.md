# KEYWORD LIBRARY

WF-03_KEYWORD_INTELLIGENCE가 채우는, 키워드와 콘텐츠 계획 상태의 누적 저장소.

| 파일 | 내용 |
|---|---|
| `keyword_library.json` | 처리된 모든 키워드의 요약 인덱스 (keyword_id, keyword, cluster, intent, template, risk, priority, status, output_path) |
| `content_inventory.json` | 계획/제작된 콘텐츠의 상태 (`PLANNED` → `ARCHITECTURE_READY` → `WRITING` → `REVIEW` → `PUBLISHED` 등) — WF-04 이후 단계가 계속 갱신한다 |
| `internal_link_map.json` | 콘텐츠 간 내부링크 그래프 (`PLANNED`/`ACTIVE`/`BROKEN`/`REMOVED`) — WF-04가 생성을 시작하고 이후 단계가 계속 갱신한다 |

키워드별 상세 판단(의미, 검색 의도, 독자 상태, 적용 Rule, 우선순위 등)은 여기가 아니라 `05_OUTPUT/briefs/`와 `04_INPUT/processed_keywords/`의 Content Brief에 저장된다. 이 라이브러리는 그 브리프들의 가벼운 인덱스다.

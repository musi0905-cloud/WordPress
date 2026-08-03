# ARCHITECTURE LIBRARY

WF-04_CONTENT_ARCHITECTURE가 채우는, 확정된 Content Blueprint의 누적 레지스트리.

| 파일 | 내용 |
|---|---|
| `architecture_registry.json` | 모든 Architecture의 요약 인덱스 (architecture_id, keyword_id, title, slug, content_type, content_role, status, version, blueprint_path) |

키워드별 상세 설계(목차, 섹션 명세, 근거 계획, 내부링크, 시각 자료, FAQ, WF-05 집필 계약 등)는 여기가 아니라 `05_OUTPUT/architecture/`의 Content Blueprint에 저장된다. 이 라이브러리는 그 Blueprint들의 가벼운 인덱스다.

내부링크 그래프(`internal_link_map.json`)는 이 폴더가 아니라 `06_MEMORY/KEYWORD_LIBRARY/`에 있다 (WF-03에서 이미 콘텐츠-키워드 관계 자산으로 예약된 위치).

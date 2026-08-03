# QUALITY LIBRARY

콘텐츠 품질 검수 기준과 축적된 품질 패턴(Quality Pattern)을 보관한다. `WF-06_QUALITY_REVIEW`가 채운다.

| 파일 | 내용 |
|---|---|
| `quality_registry.json` | 모든 심사(Review)의 요약 인덱스 (review_id, draft_id, keyword_id, status, weighted_score, grade, critical/major issue count, 최종 파일 경로) |
| `quality_history.json` | 반복적으로 발견되는 품질 문제 패턴(`quality_pattern`). WF-06은 Rule을 직접 변경하지 않고, Rule 개정이 필요하다는 신호만 여기 기록해 `WF-08_PROJECT_LEARNING`에 전달한다 |

키워드별 상세 심사 결과(영역별 점수, 발견된 문제, 수정 이력)는 여기가 아니라 `05_OUTPUT/reviewed/`의 Quality Report/Revision Log에 저장된다. 이 라이브러리는 그 심사 결과들의 가벼운 인덱스와, 프로젝트 전반에 걸쳐 누적되는 품질 패턴 저장소다.

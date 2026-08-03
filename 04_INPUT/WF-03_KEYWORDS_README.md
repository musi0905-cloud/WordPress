# WF-03 입력: 키워드 파일

`WF-03_KEYWORD_INTELLIGENCE`가 읽는 필수 입력.

위치: `04_INPUT/keywords.csv` (또는 `keywords.xlsx`)

`keywords.csv`는 헤더만 있는 빈 템플릿 상태다. 아래 열을 채워 사용한다 (열 이름이 다르거나 일부가 없어도 WF-03이 의미를 분석해 매핑한다).

| 열 | 설명 |
|---|---|
| `keyword` | 필수. 원본 키워드 |
| `monthly_search_volume` | 선택. 월간 검색량 |
| `pc_search_volume` / `mobile_search_volume` | 선택. PC/모바일 검색량 |
| `pc_cpc` / `mobile_cpc` | 선택. PC/모바일 CPC |
| `category` | 선택. 키워드 카테고리 |
| `memo` | 선택. 의미 판별에 참고할 메모 |
| `priority` | 선택. 사람이 매긴 초기 우선순위 참고값 (WF-03의 `final_priority`를 대체하지 않음) |

값이 없는 셀은 비워둔다. WF-03은 비어 있는 값을 사실처럼 추정하지 않고 `data_status: unavailable`로 기록한다.

키워드 삭제/추가/교체는 WF-03의 절대 금지 사항이다 — 이 파일에 있는 키워드만 그대로 처리된다.

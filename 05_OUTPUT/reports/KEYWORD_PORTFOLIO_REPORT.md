# Keyword Portfolio Report (WF-03)

- Run ID: 20260803-portfolio-01
- 실행일: 2026-08-03
- 입력: `04_INPUT/keywords.csv` (기존 KW-0001 1건 + 신규 100건 = 총 101건)
- 출력: `06_MEMORY/KEYWORD_LIBRARY/keyword_library.json`, `content_inventory.json`

## 1. 총괄 요약

| 항목 | 값 |
|---|---|
| 입력 키워드 수 | 101 |
| 기존 처리 완료(EXPORTED) | 1 (KW-0001) |
| 신규 분류 키워드 수 | 100 |
| 정확한 중복(문자열 동일) | 0 |
| 의미 중복 후보 | 0 |
| Cluster 수 | 3 |
| Pillar 후보 수 | 2 |
| Supporting 후보 수 | 10 |
| Standalone 키워드 수 | 89 (KW-0001 포함) |
| 카니벌라이제이션(경쟁) 그룹 수 | 1 |
| HOLD (실행 보류) 키워드 수 | 12 |

## 2. 리스크 분포 (risk_level)

| 등급 | 수 |
|---|---|
| HIGH | 29 |
| MEDIUM | 33 |
| LOW | 33 (+KW-0001) |
| UNCONFIRMED | 5 |

HIGH 리스크 29건은 의료/시술/건강기능식품/금융상품 비교 등 YMYL(Your Money or Your Life) 성격 키워드로, 콘텐츠 생성 시 효능·순위 단정 표현 금지, 출처 명시, 전문가 상담 권고 문구가 필수로 요구된다. 이 Run에서는 분류만 수행했으며 실제 문구 작성은 하지 않았다.

## 3. Content Type 분포

| 유형 | 수 |
|---|---|
| INFORMATIONAL | 73 |
| COMPARISON | 14 |
| KNOW_HOW | 8 |
| UNKNOWN(HOLD 대상) | 5 |

## 4. Search Intent 분포

| Intent | 수 |
|---|---|
| INFORMATIONAL | 48 |
| KNOW_HOW | 9 |
| LOCAL_INFO | 8 |
| SHOPPING | 7 |
| PROBLEM_SOLVING | 7 |
| UNKNOWN | 6 |
| COMPARISON | 5 |
| NAVIGATIONAL | 4 |
| PROCEDURAL | 3 |
| TRANSACTIONAL | 2 |
| LOCAL_COMMERCIAL | 1 |

## 5. Priority 분포

| Priority | 수 | 비고 |
|---|---|---|
| P1 | 25 | KW-0001 포함 |
| P2 | 36 | |
| P3 | 28 | |
| P4 | 6 | HIGH 리스크이나 HOLD로 분류하지 않은 6건(정책 확정 시 재검토 필요) |
| HOLD | 6 | 의미 불명확으로 우선순위 자체를 부여하지 않음 |

주의: `status = HOLD_NEEDS_CLARIFICATION`인 키워드는 12건이나, 그중 6건(KW-0047, KW-0074, KW-0088, KW-0094, KW-0096, KW-0100)은 의미는 명확하지만 정책 리스크가 커서 `priority=P4`로 유보성 낮은 우선순위를 부여했고, 나머지 6건(KW-0004, KW-0005, KW-0020, KW-0042, KW-0087, KW-0101)은 의미 자체가 불명확해 `priority=HOLD`로 두었다. 두 그룹 모두 실행 배치에서 제외된다.

## 6. HOLD_NEEDS_CLARIFICATION 12건 상세

| ID | 키워드 | 사유 |
|---|---|---|
| KW-0004 | 헬로우드림 | 의미 특정 불가 — 브랜드/프로그램/상품명 추정되나 확인 안 됨 |
| KW-0005 | 바나듐 | 영양제 성분 vs 금속/투자 원자재 — 중의적, 방향 확정 전 보류 |
| KW-0020 | 토론회 | 특정 토론회 지칭 가능성 — 대상 불명확 |
| KW-0042 | 따뜻한 | 단일 형용사 — 키워드 데이터 오류 가능성 |
| KW-0047 | 김소형알부민 | 특정 인물 연관 건강 제품 — 효능 오인·과장 위험 |
| KW-0074 | 부산임플란트잘하는곳 | 의료기관 "잘하는 곳" 추천형 — 허위·과장 추천 위험 매우 큼 |
| KW-0087 | 사이트 | 단일 일반명사 — 의미 특정 불가 |
| KW-0088 | 살빼는방법 | 다이어트 효과 주장 — Constitution 절대 금지 항목(허위 효과 보장)과 직결 |
| KW-0094 | 5월공모주청약일정 | 제목에 특정 월 고정 — 연도 미상, 게시 시점 판단 불가 |
| KW-0096 | 필러가격 | 시술 가격 정보 — 의료광고법 관련 민감 |
| KW-0100 | 마산치과 | 의료기관 지역 추천형 — 부산임플란트잘하는곳(KW-0074)과 동일한 위험 |
| KW-0101 | 터마신 | 특정 제품/성분명 추정되나 확인 불가 |

이 12건은 사용자 확인 없이는 Architecture(WF-04) 단계로 넘기지 않는다.

## 7. 중복 검사

- 정확한 문자열 중복: 0건
- 의미 중복 후보(유사 표현/동일 검색 의도 추정): 0건으로 판단. 단, CL-INSURANCE 클러스터 내 7개 키워드는 서로 다른 상품·상황을 다루므로 중복이 아니라 카니벌라이제이션(경쟁) 리스크로 별도 분류함(8절 참조).

## 8. Cluster / 카니벌라이제이션 상세

`CONTENT_CLUSTER_REPORT.md` 참조.

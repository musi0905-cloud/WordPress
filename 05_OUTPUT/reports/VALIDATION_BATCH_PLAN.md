# Validation Batch Plan (WF-03 → WF-04 candidate)

- Run ID: 20260803-portfolio-01
- 실행일: 2026-08-03
- 목적: 100개 전체 실행 전, 대표성 있는 소수 키워드로 생성 파이프라인 품질을 먼저 검증한다.

## 1. 선정 키워드 (5건)

| ID | 키워드 | Search Intent | Content Type | Risk | Priority |
|---|---|---|---|---|---|
| KW-0027 | 네이버쇼핑구매내역 | KNOW_HOW | INFORMATIONAL | LOW | P1 |
| KW-0011 | 소방설비기사응시자격 | INFORMATIONAL | INFORMATIONAL | LOW | P1 |
| KW-0023 | 구인구직사이트순위 | COMPARISON | COMPARISON | LOW | P1 |
| KW-0075 | 이사짐센터비용 | PROBLEM_SOLVING | INFORMATIONAL | LOW | P1 |
| KW-0099 | 반려견장례 | INFORMATIONAL | INFORMATIONAL | MEDIUM | P2 |

## 2. 선정 근거

- **의도 다양성**: KNOW_HOW, INFORMATIONAL, COMPARISON, PROBLEM_SOLVING을 각각 대표하는 키워드를 1개 이상 포함해, 파이프라인이 서로 다른 문서 구조 요구에 대응 가능한지 검증한다.
- **낮은 리스크 우선**: 5건 중 4건이 LOW, 1건이 MEDIUM 리스크로, YMYL 민감도가 낮은 항목부터 검증해 초기 오류를 안전하게 확인한다. HIGH/UNCONFIRMED/HOLD 키워드는 검증 배치에서 의도적으로 제외했다.
- **상호 카니벌라이제이션 없음**: 5건은 서로 다른 산업/주제(쇼핑 이력 조회, 자격증 시험, 구인구직 사이트, 이사 비용, 반려동물 장례)를 다루어 검색 의도가 겹치지 않는다.
- **Cluster 비의존**: 5건 모두 Standalone이므로, 검증 결과가 Cluster 간 내부 링크 설계 미비 등 부차적 요인에 영향받지 않는다.
- **Priority 대표성**: P1 4건 + P2 1건으로, 실제 실행 우선순위 상위 구간을 반영한다.

## 3. 검증 절차 (제안, 아직 미실행)

1. 각 키워드에 대해 WF-03(Brief) → WF-04(Architecture) → WF-05(Draft) → WF-06(Quality Review) → WF-07(Export, EXPORT_ONLY)를 KW-0001과 동일한 방식(Claude LLM 판단 기반, Python은 기계적 처리만)으로 실행한다.
2. WF-06 품질 게이트(가중 점수 92 이상, Critical=0, Major=0)를 통과해야 Export로 진행한다.
3. 5건 모두 완료 후, 사용자에게 결과를 보고하고 승인받은 뒤에만 나머지 Batch(4개)로 확장한다.

## 4. 상태

- 현재 상태: **미실행 (계획만 수립)**. 사용자가 지정한 순서(레퍼런스 분석 → 키워드 정리 → 대표 검증 → WordPress 연동 → 중복/업데이트 검증 → 전체 Batch 처리)에서 이번 Run은 2단계(키워드 정리)까지이며, 3단계(대표 검증 실제 실행)는 사용자의 별도 지시 없이는 시작하지 않는다.

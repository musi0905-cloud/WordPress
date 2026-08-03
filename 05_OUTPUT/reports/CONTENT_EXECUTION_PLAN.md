# Content Execution Plan (WF-03 output → future WF-04~WF-07 batches)

- Run ID: 20260803-portfolio-01
- 실행일: 2026-08-03
- 상태: **계획만 수립, 실행 없음.** 사용자 지시("100개를 첨부하자마자 전부 작성시키면 안 돼")에 따라 이번 Run에서는 어떤 콘텐츠도 생성하지 않았다.

## 1. Batch 구조

| Batch | 키워드 수 | 설명 |
|---|---|---|
| BATCH-0-VALIDATION | 5 | 대표 검증 배치 (`VALIDATION_BATCH_PLAN.md`) — 파이프라인 품질 확인 전에는 다른 Batch로 진행하지 않음 |
| BATCH-1 | 20 | P1 우선순위 중심 |
| BATCH-2 | 30 | P2 우선순위 중심 |
| BATCH-3 | 16 | P3 우선순위 중심 |
| BATCH-4 | 17 | P3/P4 및 잔여 항목 |
| HOLD | 12 | 실행 배치에서 완전히 제외 (아래 3절 참조) |
| (기처리) | 1 | KW-0001 — 이미 WF-07까지 완료(EXPORTED), Batch 배정 대상 아님 |
| **합계** | **101** | |

Batch 배정은 `06_MEMORY/KEYWORD_LIBRARY/keyword_library.json`의 `execution_batch` 필드에 저장되어 있으며, 실제 Batch 인원 구성은 우선순위(priority)와 리스크(risk_level)를 함께 고려해 특정 Batch에 HIGH 리스크 키워드나 특정 Cluster/Template이 과도하게 몰리지 않도록 분산했다.

## 2. 실행 순서 원칙

1. **BATCH-0-VALIDATION 우선.** 5건이 WF-06 품질 게이트를 통과하고 사용자 승인을 받기 전에는 BATCH-1 이후를 시작하지 않는다.
2. **소규모 순차 처리.** 각 Batch 내에서도 한 번에 전체를 생성하지 않고, 사용자가 지정하는 단위(예: 5~10건씩)로 나누어 진행한다.
3. **Batch 간 검증.** 각 Batch 완료 후 WF-06 통과율, 반려 사유, 소요 시간 등을 사용자에게 보고하고 다음 Batch 진행 여부를 확인받는다.
4. **HOLD 우선 처리 금지.** HOLD 12건은 사용자의 명시적 방향 확정 없이는 어떤 Batch에도 편입하지 않는다.

## 3. HOLD 목록 (12건, Batch 배정 제외)

의미 불명확(6건): KW-0004, KW-0005, KW-0020, KW-0042, KW-0087, KW-0101
정책 리스크 확정 필요(6건): KW-0047, KW-0074, KW-0088, KW-0094, KW-0096, KW-0100

상세 사유는 `KEYWORD_PORTFOLIO_REPORT.md` 6절 참조. 사용자가 각 항목에 대해 (a) 의미를 확정하거나 (b) 진행/보류/폐기 방향을 지정하면 그때 Batch에 편입한다.

## 4. 다음 단계 (사용자 승인 필요)

- 이번 Run 산출물(본 보고서 포함)을 사용자가 검토
- 승인 시 → 3단계(대표 3~5개 생성 품질 검증, `VALIDATION_BATCH_PLAN.md`) 착수
- 3단계 통과 시 → 4단계(WordPress Draft 연동) 진행 여부 별도 확인
- 이번 Run에서는 콘텐츠 생성, WordPress 연동을 포함한 어떠한 3~7단계 작업도 수행하지 않았다.

# 15_REMEDIATION/cases

Remediation Case를 상태(STEP 12 REMEDIATION STATES)에 따라 물리적으로 분리 저장한다. Case 파일: `CASE-<id>.json` (형식: `CASE-YYYYMMDD-0001`).

| 하위 디렉토리 | 대응 Case 상태 |
|---|---|
| `open/` | `NEW`, `VALIDATING`, `PLANNED` |
| `active/` | `IN_PROGRESS`, `WAITING_FOR_UPSTREAM` |
| `validation/` | `VALIDATING_CHANGES`, `WAITING_FOR_MANUAL_REVIEW` |
| `resolved/` | `RESOLVED`, `PARTIALLY_RESOLVED` |
| `blocked/` | `BLOCKED`, `FAILED` |
| `archived/` | `ARCHIVED` |

Case는 상태 전이 시 해당 디렉토리로 이동하며, 동일 Finding에 대해 중복 Case를 생성하지 않는다 (STEP 17 IDEMPOTENCY AND VERSION CONTROL 참조).

# 17_GOVERNANCE/releases

Release를 상태(STEP 13 GOVERNANCE STATES — Release 상태)에 따라 물리적으로 분리 저장한다. Release 파일: `REL-<id>.json` (형식: `REL-YYYYMMDD-0001`).

| 항목 | 내용 |
|---|---|
| `pending/` | `DRAFT`, `READY`, `DEPLOYING` |
| `active/` | `RELEASED` (현재 운영 중인 최신 Release) |
| `superseded/` | `SUPERSEDED`, `FAILED`, `ROLLED_BACK` |
| `release_registry.json` | 전체 Release 누적 인덱스 |

정식 반영(STEP 24 PRODUCTION RELEASE)은 `release_gate`의 모든 조건(Proposal 승인, Change Set 검증, WF-10 통과, Rollout 통과, Rollback 준비, Release Notes, Snapshot, Version, Lock)을 충족한 경우에만 수행되며, 기존 파일은 Archive 후 교체된다.

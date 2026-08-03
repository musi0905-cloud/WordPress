# 17_GOVERNANCE/runtime

| 파일 | 내용 |
|---|---|
| `governance_state.json` | 마지막 Governance Run 상태, Change Freeze 여부, 열린 Proposal/Change Set 수 |
| `active_proposal.json` | 현재 검토 중인 Proposal과 진행 단계 |
| `active_changeset.json` | 현재 진행 중인 Change Set과 진행 단계 |
| `governance_lock.json` | 동시 실행 방지 Lock (`locked`, Heartbeat) |
| `release_state.json` | 현재 Project Version, Pending Release, 최근 Rollback |

`governance_lock.json`이 `locked: true`인 동안에는 새로운 WF-15 실행을 시작하지 않으며, `governance_state.json.change_freeze_active`가 `true`인 동안에는 PATCH 수준 보안 수정을 제외한 신규 Release를 중단한다 ("21. CHANGE FREEZE POLICY" 참조).

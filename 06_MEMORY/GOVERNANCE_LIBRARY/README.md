# GOVERNANCE LIBRARY

WF-15_GOVERNANCE_AND_CHANGE_CONTROL이 채우는, 프로젝트 핵심 자산 변경 제안·심사·배포·롤백의 누적 저장소.

| 파일 | 내용 |
|---|---|
| `governance_registry.json` | Change Proposal 누적 인덱스 (출처, Domain, 변경 등급, 우선순위, 상태, 연결된 Change Set/Release, 판정) |
| `change_control_history.json` | Proposal, Test, Rollout, Release, Rollback 전 과정 이력 |
| `release_history.json` | 정식 반영된 Release 이력 (버전, 이전 버전, 유형, 상태, Rollback 가능 여부) |
| `rollback_history.json` | Rollback 실행 이력과 사유, 회귀 검증 결과 |
| `approved_change_registry.json` | 승인된 변경(자동/수동)의 누적 기록 |
| `rejected_change_registry.json` | 거절된 변경과 거절 사유의 누적 기록 |

이 라이브러리는 Project Constitution, Content DNA, Rule/Template/Workflow 정의, Quality Gate, Security/Publication Policy 등 핵심 자산에 대해 정식 Change Proposal과 검증(Sandbox → WF-10 → Limited Rollout) 없이 이루어진 변경을 기록하지 않는다. 단일 사례를 근거로 한 전체 Rule/Template 일반화는 승인 기록에 남지 않으며, Rollback History와 Release History는 삭제되지 않는다.

WF-15는 이 라이브러리를 근거로 자체 판단 범위 밖의 변경(Constitution, Content DNA 핵심 정의, 보안/게시 정책, Workflow Major 변경 등)을 자동 승인하지 않는다 — 해당 변경은 항상 `MANUAL_APPROVAL_REQUIRED` 상태로 남아 사람의 결정을 기다린다.

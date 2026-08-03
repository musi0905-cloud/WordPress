# 17_GOVERNANCE

WF-15_GOVERNANCE_AND_CHANGE_CONTROL의 전용 디렉토리. WF-08(학습), WF-10(검증), WF-11(운영), WF-12(성과), WF-13(복구), WF-14(최적화)에서 생성되는 모든 변경 후보를 중앙에서 접수해, 근거·영향도·위험도·Constitution 충돌 여부를 검토한 뒤 승인된 변경만 Sandbox → WF-10 테스트 → 제한 배포 → 정식 Release 순서로 반영한다. 검증되지 않은 변경이 곧바로 운영에 반영되는 것을 막는 프로젝트의 중앙 변경 통제 계층이다.

| 하위 디렉토리 | 내용 |
|---|---|
| `config/` | Governance/변경 등급 분류/승인/제한 배포/Rollback/Release 정책 6종 (모두 안전 기본값으로 시딩됨) |
| `intake/` | 원본 변경 제안 입력 (WF-08/WF-10/WF-11/WF-12/WF-13/WF-14 출처별, 수동, 가져오기) |
| `proposals/` | Change Proposal 상태별 저장소 (`new`~`archived`) |
| `changesets/` | Change Set 상태별 저장소 (`draft`/`sandbox`/`validated`/`rollout`/`released`/`rolled_back`) |
| `queue/` | Proposal/Validation/Test/Approval/Rollout/Rollback Queue |
| `runtime/` | 현재 Governance 상태, 활성 Proposal·Change Set, Lock, Release 상태 |
| `snapshots/` | 변경 전/후/Release/Rollback Snapshot |
| `releases/` | Release 상태별 저장소 (`pending`/`active`/`superseded`)와 Release Registry |
| `reports/` | Governance/Change Control/Release/Rollback 리포트, Proposal별 리포트 |

WF-15는 Project Constitution, Content DNA, Rule/Template/Workflow 정의, Quality Gate, Security/Publication Policy, WordPress 권한 등 핵심 자산을 정식 Change Proposal 없이 변경하지 않으며(PATCH 수준 예외 제외), 품질·보안 기준을 낮추는 변경은 기본적으로 거절한다. 승인과 배포는 항상 분리되어 있다(`PROPOSED → VALIDATED → APPROVED_FOR_TEST → TESTING → TEST_PASSED → APPROVED_FOR_ROLLOUT → LIMITED_ROLLOUT → PRODUCTION_VALIDATED → RELEASED`). 모든 변경은 Snapshot과 Rollback 경로를 필수로 가지며, Constitution/Content DNA/보안/게시 정책 등 핵심 변경은 수동 승인 없이 자동 Release되지 않는다.

# 17_GOVERNANCE/intake

Change Proposal의 원본 입력을 출처별로 보관한다 (STEP 02 CHANGE PROPOSAL COLLECTION 참조).

| 하위 디렉토리 | 내용 |
|---|---|
| `learning_proposals/` | WF-08 Project Learning의 Change Proposal 원본 |
| `test_findings/` | WF-10 System Validation의 테스트 이슈 원본 |
| `operations_incidents/` | WF-11 Production Operations의 Incident 원본 |
| `performance_proposals/` | WF-12 Performance Intelligence의 Finding 원본 |
| `remediation_proposals/` | WF-13 Remediation의 Proposal 원본 |
| `optimization_proposals/` | WF-14 Optimization의 Experiment Finding 원본 |
| `manual_proposals/` | 사람이 직접 입력한 Change Proposal |
| `imported/` | 외부에서 가져온(import) 원본 사본 |

모든 Proposal은 출처를 추적할 수 있어야 하며(`source_traceable`), 출처 불명 Proposal은 무결성 검사를 통과하지 못한다.

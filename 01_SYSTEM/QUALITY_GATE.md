# QUALITY GATE — Content OS

WF-16_FINAL_COMMAND_CENTER "13. QUALITY GATE" 참조.

## 콘텐츠 게시 Gate

```yaml
quality_gate:
  minimum_score: 92
  critical_issues: 0
  major_issues: 0
  factuality_passed: true
  source_quality_passed: true
  originality_passed: true
  policy_passed: true
  html_valid: true
  architecture_compliant: true
```

WF-06_QUALITY_REVIEW이 이 Gate를 실제로 적용한다. 가중 점수 92점 미만이거나 Critical/Major 문제가 하나라도 남아 있으면 WF-07로 전달되지 않는다.

## 시스템 Release Gate

```yaml
release_gate:
  proposal_approved: true
  snapshot_created: true
  rollback_valid: true
  wf10_passed: true
  security_passed: true
  regression_passed: true
  rollout_passed: true
```

WF-15_GOVERNANCE_AND_CHANGE_CONTROL이 이 Gate를 실제로 적용한다. 조건을 모두 충족하지 못한 변경은 정식 Release로 반영되지 않는다.

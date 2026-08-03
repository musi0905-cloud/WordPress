# ERROR POLICY — Content OS

WF-16_FINAL_COMMAND_CENTER "14. ERROR POLICY" 참조.

## 심각도

```text
INFO
WARNING
MODERATE
MAJOR
CRITICAL
```

## 오류 유형

```text
INPUT
CONFIG
FILESYSTEM
SCHEMA
DEPENDENCY
HANDOFF
CONTENT
FACTUALITY
SOURCE
POLICY
SECURITY
WORDPRESS
PERFORMANCE
REMEDIATION
OPTIMIZATION
GOVERNANCE
RUNTIME
LOCK
REGISTRY
```

## 오류 구조

```yaml
error:
  error_id:
  run_id:
  workflow_id:
  content_id:
  category:
  severity:
  stage:
  description:
  root_cause:
  affected_items: []
  retryable:
  rollback_required:
  recovery_workflow:
  recovery_action:
  status:
```

오류가 발생하면 원인, 영향, 수정 방법, 재실행 방법을 기록한 후 종료한다 (Project Constitution "Error Policy" 참조). 전체를 완료할 수 없는 경우에도 완료된 범위, 차단 원인, 필요한 반환 Workflow를 정확히 기록한다.

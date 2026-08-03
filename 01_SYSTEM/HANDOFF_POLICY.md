# HANDOFF POLICY — Content OS

WF-16_FINAL_COMMAND_CENTER "12. HANDOFF POLICY" 참조.

모든 Workflow Handoff는 다음 구조를 가져야 한다.

```yaml
handoff:
  source_workflow:
  next_workflow:
  status:
  ready:
  input_paths: []
  output_paths: []
  blocking_issues: []
  warnings: []
  version:
  created_at:
```

## 금지 사항

- `ready: false`인데 다음 Workflow 실행
- Blocking Issue 무시
- 존재하지 않는 Output 경로 전달
- 다른 Content ID 전달
- Version 불일치
- 상태 누락
- Handoff 파일 없이 강제 진행

이 정책은 WF-01→WF-02, WF-02→WF-03, ..., WF-07→WF-08의 파이프라인 Handoff뿐 아니라, WF-09(Orchestration), WF-13/WF-14의 Workflow Return Queue, WF-15의 Change Set/Release Handoff에도 동일하게 적용된다.

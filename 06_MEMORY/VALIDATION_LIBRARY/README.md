# VALIDATION LIBRARY

WF-10_SYSTEM_VALIDATION이 채우는, 시스템 검증(Acceptance Test) 이력의 누적 저장소.

| 파일 | 내용 |
|---|---|
| `system_validation_registry.json` | Test Run 누적 인덱스 (test_run_id, 상태, 테스트 수, Critical/Major 실패 수, End-to-End/Security/WordPress 안전 테스트 결과, 리포트 경로) |
| `test_history.json` | 반복적으로 실패하는 테스트 패턴 (test_failure_pattern — 어떤 워크플로우에서, 얼마나 자주, 언제부터) |
| `regression_baseline.json` | 최초로 `ACCEPTED`/`ACCEPTED_WITH_WARNINGS`를 받은 시점의 기준선. 이후 모든 Test Run은 이 Baseline과 비교되며, Critical/Major Regression이 있으면 Acceptance가 차단된다 |

이 라이브러리는 `06_MEMORY/WORKFLOW_LIBRARY/`(WF-08의 *운영 성과* 학습)나 `06_MEMORY/ORCHESTRATION_LIBRARY/`(WF-09의 *실행 이력*)와 다른 목적을 가진다 — 이 라이브러리는 "시스템 자체가 설계대로 동작하는가"를 검증한 결과를 기록한다.

새 Baseline은 기존 Baseline을 덮어쓰지 않는다. 이전 Baseline은 `09_ARCHIVE/WF-10/baselines/<timestamp>/`에 보관한다.

테스트 1회 실행분의 상세 결과와 Fixture는 여기가 아니라 `12_TEST/`에 저장된다. 이 라이브러리는 그 실행들의 누적 이력이다.

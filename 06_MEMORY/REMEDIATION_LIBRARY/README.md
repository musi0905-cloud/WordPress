# REMEDIATION LIBRARY

WF-13_ADSENSE_AND_SITE_REMEDIATION이 채우는, 애드센스/사이트/콘텐츠 문제에 대한 수정(Remediation) 이력의 누적 저장소.

| 파일 | 내용 |
|---|---|
| `remediation_registry.json` | Remediation Case 누적 인덱스 (Case ID, Site/Application ID, 우선순위, 상태, 공식 사유, Issue/Action 건수, Readiness 상태) |
| `remediation_history.json` | Case별 수정·검증·재발 여부 이력 |
| `site_readiness_history.json` | Site Readiness 평가 이력 (STEP 22) |
| `reapplication_readiness_history.json` | Reapplication Readiness 평가 이력 (STEP 23) — Google 승인 결과 자체가 아니라 내부 준비 상태 기록 |
| `remediation_learning_queue.json` | WF-08에 전달할 Remediation Learning Package — Root Cause, 성공/실패한 수정, Rollback 이력에서 도출된 Rule/Template/Workflow 변경 후보 |

이 라이브러리는 공식적으로 확인되지 않은(`UNCONFIRMED`) 문제를 사실로 기록하지 않으며, 애드센스 승인/재승인 가능성을 어떤 필드에도 보장 형태로 기록하지 않는다.

WF-13은 이 라이브러리를 근거로 Rule/Content DNA/Workflow/Constitution을 직접 변경하지 않는다 — 변경 필요성은 오직 `remediation_learning_queue.json`을 통해 WF-08에 제안으로만 전달된다.

# WORKFLOW LIBRARY

프로젝트 전체 Workflow 실행 결과를 학습한 산출물을 보관한다. `WF-08_PROJECT_LEARNING`이 채운다.

| 파일 | 내용 |
|---|---|
| `learning_registry.json` | Learning Run 누적 인덱스 (learning_run_id, 분석 범위, 데이터 신뢰도, 자동 적용/제안 개수, 건강도 점수) |
| `rule_performance.json` | Rule별 적용 성과 (application/success/failure/conflict count, recommendation) |
| `template_performance.json` | Template별 실제 성과 (사용 횟수, 각 단계 통과율, 평균 품질 점수) |
| `workflow_performance.json` | WF-01~WF-07 각각의 성공률/실패율/차단율/재시도율/성능 등급 — 이 라이브러리가 애초에 "워크플로우 패턴"용으로 예약되었던 목적 그 자체 |
| `content_dna_history.json` | Content DNA 버전별 유효성 검토 이력 |
| `decision_tree_history.json` | Decision Tree 버전별 정확도 검토 이력 |
| `change_proposals.json` | 자동 적용하지 못한 변경 제안 (PROPOSED → APPROVED/REJECTED → APPLIED/ROLLED_BACK) — WF-08은 제안만 하고 자동 승인하지 않는다 |
| `project_health.json` | 프로젝트 전체 건강도 (영역별 점수, 종합 등급, 차단 조건) |
| `project_versions.json` | 프로젝트 버전 이력 (PATCH/MINOR/MAJOR, 변경 내역, rollback snapshot 경로) |

WF-08이 자동으로 반영할 수 있는 변경은 PATCH 수준(오탈자, 상태값, 통계, 경로)으로 제한된다. Rule/Pattern/Template 삭제, Content DNA 핵심 변경, 품질·안전 기준 완화는 절대 자동 적용되지 않고 `change_proposals.json`에 제안으로만 남는다 — 승인은 사람의 몫이다.

변경 전 스냅샷은 `09_ARCHIVE/WF-08/<timestamp>/`에 보관되며, 모든 자동 변경은 되돌릴 수 있어야 한다 (WF-08 문서 "12. ROLLBACK POLICY" 참조).

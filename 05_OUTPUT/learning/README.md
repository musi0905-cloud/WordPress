# 05_OUTPUT/learning

WF-08_PROJECT_LEARNING이 실행 1회분마다 생성하는 학습 산출물을 보관한다.

- `WF-08_LEARNING_REPORT.md` / `.json` — 실행 종합 리포트 (프로젝트 건강도, Workflow별 분석, Rule/Pattern/Template 성과, 반복 오류, 자동 적용 변경, Change Proposals)
- `learning_package.json` — 다음 Workflow 실행이 참조하는 학습 패키지 (findings, 자동 적용 변경, 제안, 다음 실행 지시사항)
- `rule_change_plan.json`, `template_change_plan.json`, `workflow_change_plan.json` — 영역별 변경 계획
- `content_dna_review.json`, `decision_tree_review.json` — Content DNA/Decision Tree 유효성 검토 결과
- `project_health_report.md` — 프로젝트 건강도 리포트
- `change_proposals.md` — 사람이 검토할 Change Proposal 목록 (사람 승인 없이는 적용되지 않음)

누적 자산(Rule/Template/Workflow Performance, Change Proposals, Project Health/Version 이력)은 `06_MEMORY/WORKFLOW_LIBRARY/`에 저장되며, 이 디렉토리의 파일은 "실행 1회분"의 산출물이다.

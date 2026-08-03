# 15_REMEDIATION

WF-13_ADSENSE_AND_SITE_REMEDIATION의 전용 디렉토리. WF-12가 관찰·분석한 애드센스 거절, 색인 문제, 콘텐츠 품질 문제, 사이트 구조 문제 중 근거가 확인된 항목만 선별해 실제 수정 작업(Remediation Case)으로 전환하고, 수정 후 재검증까지 관리한다.

| 하위 디렉토리 | 내용 |
|---|---|
| `config/` | Remediation/우선순위/콘텐츠 처리/재신청/Rollback 정책 (모두 안전 기본값으로 시딩됨) |
| `intake/` | WF-12 및 수동 검토에서 들어오는 원본 Finding (애드센스/색인/품질/기술/수동/가져오기) |
| `cases/` | Remediation Case 상태별 저장소 (`open`/`active`/`validation`/`resolved`/`blocked`/`archived`) |
| `plans/` | Case별 수정 계획 (콘텐츠/사이트/기술/정책/재신청) |
| `queue/` | Remediation Queue, Workflow Return Queue, Manual Review Queue, Validation Queue |
| `runtime/` | 현재 Remediation 상태, 활성 Case, Lock, 진행 중인 검증 |
| `snapshots/` | 변경 전/후/비교 Snapshot (`before`/`after`/`comparison`) |
| `reports/` | Remediation/AdSense Remediation/Site Readiness/Reapplication Readiness 리포트, Case별 리포트 |

WF-13은 애드센스 승인 가능성을 보장하지 않으며, 공식적으로 확인되지 않은(`UNCONFIRMED`) 문제를 근거로 대규모 수정을 수행하지 않는다. 콘텐츠 삭제보다 보존과 수정을 우선하며(`KEEP → CORRECT → EXPAND_IF_NEEDED → MERGE → REDIRECT → NOINDEX → ARCHIVE → DELETE_PROPOSAL`), 모든 자동 수정은 변경 전 Snapshot과 Rollback 경로를 가진다. 애드센스 재신청은 어떤 경우에도 자동 제출하지 않는다.

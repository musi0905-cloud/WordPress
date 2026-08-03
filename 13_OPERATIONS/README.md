# 13_OPERATIONS

WF-11_PRODUCTION_OPERATIONS의 운영 전용 디렉토리. WF-10을 통과한 시스템을 실제 운영으로 전환하고, 일상적인 콘텐츠 생산 Batch를 관리한다. `12_TEST/`(테스트 전용)와 물리적으로 분리되어 있으며, 서로의 입력/출력을 절대 혼용하지 않는다.

| 하위 디렉토리 | 내용 |
|---|---|
| `config/` | 운영 정책 설정 (Batch/비용/모니터링/Incident/보존 — 모두 안전 기본값으로 시딩됨) |
| `intake/` | 신규 키워드 입력 접수 파이프라인 (`pending` → `accepted`/`rejected` → `processed`), 수동 검토 결과(`manual_review_results/`) |
| `batches/` | Batch 생명주기별 보관 (`planned` → `active` → `completed`/`blocked` → `archived`) |
| `queue/` | 실행 대기열 (Production/Manual Review/WordPress Sync/Learning) |
| `runtime/` | 현재 운영 상태, 활성 Batch, Production Lock, 자원 사용량, Heartbeat |
| `incidents/` | 장애 기록 (`open`/`resolved`, `incident_registry.json`) |
| `metrics/` | 일일/워크플로우/콘텐츠/비용/게시 지표 |
| `reports/` | Daily Operations Report, Batch/Incident/Cost 리포트 |

기본 게시 상태는 항상 `WORDPRESS_DRAFT`다. 자동 예약/공개는 `config/operations_config.yaml`의 `publication.allow_schedule`/`allow_publish`가 명시적으로 `true`이고, 그 외 모든 안전 조건이 충족된 경우에만 가능하다 — 기본값은 둘 다 `false`다.

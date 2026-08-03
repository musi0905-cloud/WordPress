# 14_PERFORMANCE

WF-12_PERFORMANCE_AND_APPROVAL_INTELLIGENCE의 전용 디렉토리. 실제 운영 이후의 색인, 검색 노출, 사용자 반응, 애드센스 신청/승인 결과를 수집·정규화·검증한다. 존재하지 않는 데이터는 절대 추정해서 채우지 않는다 — 없으면 `UNAVAILABLE`/`INSUFFICIENT_DATA`로 기록한다.

| 하위 디렉토리 | 내용 |
|---|---|
| `config/` | 분석/관찰기간/애드센스 추적/귀속/알림 정책 (모두 안전 기본값으로 시딩됨) |
| `intake/` | 원본 외부 데이터 (Search Console/Analytics/WordPress/AdSense/색인/수동 결과/기타) |
| `normalized/` | 표준 Schema로 정규화된 성과 데이터 (콘텐츠/쿼리/페이지/색인/애드센스/수익) |
| `snapshots/` | 일간/주간/월간/애드센스 이벤트 스냅샷 (동일 기간 중복 생성 안 함) |
| `alerts/` | 이상 징후 알림 (`open`/`resolved`, `alert_registry.json`) |
| `reports/` | Performance/Indexing/AdSense Approval/Content Performance/Site Health 리포트 |
| `runtime/` | 현재 분석 상태, Lock, 데이터 소스 상태 |

애드센스 승인/거절은 공식 출처(`OFFICIAL_EXPORT`/`DIRECT_API`/`PLATFORM_REPORT`/`MANUAL_VERIFIED`)로만 확정되며, 예측이나 추론은 승인 결과로 취급되지 않는다. 상관관계 분석은 허용되지만 인과관계 주장(`causality_confirmed: true`)은 이 워크플로우의 절대 금지 항목이다.

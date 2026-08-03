# 15_REMEDIATION/intake

WF-12 및 수동 검토에서 들어오는 원본 Finding을 유형별로 보관한다 (STEP 02 FINDING COLLECTION 참조).

| 하위 디렉토리 | 내용 |
|---|---|
| `adsense_findings/` | 애드센스 공식 거절/Action Required 결과 |
| `indexing_findings/` | 색인 제외, Canonical 오류, Robots/Noindex 오류, Soft 404 등 |
| `quality_findings/` | WF-06 품질 문제, 저가치·중복 콘텐츠 위험 |
| `technical_findings/` | WordPress 게시 구성 오류, Sitemap/HTTP 상태 문제 |
| `manual_findings/` | 사람이 직접 입력한 검토 결과 |
| `imported/` | 외부에서 가져온(import) 원본 Finding 원본 사본 |

Finding은 출처 불명이거나 위조가 의심되면 STEP 01 환경 검증에서 실행을 차단한다.

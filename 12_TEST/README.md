# 12_TEST

WF-10_SYSTEM_VALIDATION 전용 테스트 환경. 운영 데이터(`03_REFERENCE/`~`11_REPORTS/`)와 물리적으로 분리되어 있으며, WF-10은 이 디렉토리 밖의 운영 파일을 절대 테스트 출력으로 덮어쓰지 않는다.

| 하위 디렉토리 | 내용 |
|---|---|
| `fixtures/` | 최소 테스트 입력 (Reference/Keyword/Config/Source/WordPress Mock/의도적으로 깨진 파일) |
| `runtime/` | 테스트 실행 중 WF-09 스타일 runtime 상태의 테스트 전용 사본 |
| `output/WF-01/`~`WF-09/` | 각 워크플로우 Unit Test가 생성하는 산출물 |
| `logs/` | 테스트 실행 로그 |
| `reports/` | SYSTEM_VALIDATION_REPORT, ACCEPTANCE_REPORT 등 (`02_WORKFLOW/WF-10_SYSTEM_VALIDATION.md`의 "6. REQUIRED OUTPUT" 참조) |
| `snapshots/` | Archive/Rollback 테스트(STEP 27)용 스냅샷 |
| `test_registry.json` | 이번 Test Run의 전체 결과 레지스트리 |

WordPress 테스트는 기본적으로 `MOCK` 모드만 사용한다. 실제 운영 사이트에서 WF-10을 실행하는 경우에도 `DRAFT_ONLY` 이상은 절대 허용하지 않는다 (publish/future/delete 금지).

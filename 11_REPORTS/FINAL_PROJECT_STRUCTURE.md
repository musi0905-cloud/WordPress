# Content OS Final Project Structure

WF-16_FINAL_COMMAND_CENTER "4. FINAL PROJECT STRUCTURE" 기준으로 실제 저장소 구조를 확정한다. 표준 경로 대비 실제 경로 매핑은 각 워크플로우 문서의 "0.1 ASSET PATH MAPPING"을 따른다.

```text
Content-OS/ (저장소 루트)
│
├── CLAUDE.md                          최종 진입점 (WF-16 재작성)
├── README.md                          프로젝트 구조/파이프라인/사용법
├── 00_PROJECT_CONSTITUTION/
│   └── CONSTITUTION.md                v2.5, 최상위 규범
│
├── 01_SYSTEM/                         WF-16이 최초로 채움
│   ├── SYSTEM_PROMPT.md
│   ├── CORE_RULES.md
│   ├── QUALITY_GATE.md
│   ├── ERROR_POLICY.md
│   ├── COMMAND_ROUTER.md
│   ├── STATE_MACHINE.md
│   ├── SECURITY_POLICY.md
│   └── HANDOFF_POLICY.md
│
├── 02_WORKFLOW/                       WF-01~WF-16, 16개 정의 문서
│
├── 03_REFERENCE/                      WF-01 참고 사이트 원본/스냅샷
├── 04_INPUT/                          키워드, 게시/사이트/WordPress 설정
├── 05_OUTPUT/                         WF-01~WF-08 실행 1회분 산출물
│
├── 06_MEMORY/                         18개 영구 자산 Library
│   ├── REFERENCE_LIBRARY/ RULE_LIBRARY/ PATTERN_LIBRARY/ TEMPLATE_LIBRARY/
│   ├── KEYWORD_LIBRARY/ ARCHITECTURE_LIBRARY/ DRAFT_LIBRARY/ QUALITY_LIBRARY/
│   ├── KNOWLEDGE_LIBRARY/ PUBLICATION_LIBRARY/ WORKFLOW_LIBRARY/
│   ├── ORCHESTRATION_LIBRARY/ VALIDATION_LIBRARY/ OPERATIONS_LIBRARY/
│   ├── PERFORMANCE_LIBRARY/ REMEDIATION_LIBRARY/ OPTIMIZATION_LIBRARY/
│   ├── GOVERNANCE_LIBRARY/
│   └── COMMAND_CENTER_LIBRARY/        WF-16 신규 (18번째)
│
├── 07_TEMPLATE/                       예약 (사람이 정의한 원본 템플릿)
├── 08_LOG/                            WF-01~WF-16 실행 로그
├── 09_ARCHIVE/                        WF-01~WF-16 변경 전 스냅샷
│
├── 10_RUNTIME/                        WF-09 실행 상태, WF-16이 WF-01~16 범위로 확장
├── 11_REPORTS/                        WF-09 마스터 리포트 + WF-16 최종 통합 리포트 (이 문서 포함)
├── 12_TEST/                           WF-10 격리 테스트 환경
├── 13_OPERATIONS/                     WF-11 운영 환경
├── 14_PERFORMANCE/                    WF-12 성과/애드센스 분석 환경
├── 15_REMEDIATION/                    WF-13 복구 환경
├── 16_OPTIMIZATION/                   WF-14 최적화 환경
└── 17_GOVERNANCE/                     WF-15 변경 통제 환경
```

## 구조 검증 결과 (19.1)

- 필수 폴더 존재: PASSED (00~17, 18개 최상위 디렉터리 모두 존재)
- Workflow 16개 존재: PASSED (`02_WORKFLOW/WF-01`~`WF-16`)
- CLAUDE.md 존재: PASSED
- Project Constitution 존재: PASSED (v2.5)
- System 파일 존재: PASSED (`01_SYSTEM/` 8개)
- Config 파일 존재: PASSED (`04_INPUT/`, `13_OPERATIONS/config/`~`17_GOVERNANCE/config/`)
- Runtime 파일 존재: PASSED (`10_RUNTIME/` 8개 파일)
- Registry 파일 존재: PASSED (`06_MEMORY/` 18개 Library)

이 저장소는 WF-01 스펙에 있던 "표준 `Content-OS/` 레이아웃"을 그대로 쓰지 않고 중첩된 실제 경로를 쓰기 때문에, 모든 Workflow 문서는 "0.1 ASSET PATH MAPPING" 섹션으로 표준 경로 → 실제 경로를 명시적으로 연결한다. 이 문서가 그 최종 스냅샷이다.

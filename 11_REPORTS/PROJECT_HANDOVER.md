# Content OS Project Handover

## 1. 프로젝트 목적

Content OS는 벤치마킹 사이트의 문장을 복제하는 시스템이 아니라, 검증된 사이트에서 추출한 구조적 Rule/Pattern/Template/Content DNA를 활용해 독창적이고 정확한 콘텐츠를 기획·작성·검수·배포·분석·개선하는 콘텐츠 운영체제다. WF-01~WF-16, 16개의 독립 실행 가능한 Workflow 명세 문서의 연쇄로 구현되어 있다.

## 2. 전체 Workflow

| Workflow | 역할 |
|---|---|
| WF-01 | Reference Analysis — 구조/패턴 추출 (콘텐츠 생성 안 함) |
| WF-02 | Knowledge Engineering — Rule/Pattern/Template → Content DNA/Decision Tree 압축 |
| WF-03 | Keyword Intelligence — 키워드별 Content Brief |
| WF-04 | Content Architecture — Content Blueprint/Writing Contract |
| WF-05 | Content Generation — 본문 집필 |
| WF-06 | Quality Review — 92점 기준 21단계 검수 |
| WF-07 | Export and Publishing — Export/WordPress Draft |
| WF-08 | Project Learning — Rule/Template 성과 학습, PATCH 자동 반영 |
| WF-09 | Master Orchestration — WF-01~08 통합 실행/복구 |
| WF-10 | System Validation — `12_TEST/`에서 전체 검증 |
| WF-11 | Production Operations — Batch/비용/Incident 운영 |
| WF-12 | Performance and Approval Intelligence — 색인/검색/애드센스 실데이터 분석 |
| WF-13 | AdSense and Site Remediation — 확인된 문제 복구 |
| WF-14 | Content Optimization — 정상 콘텐츠 성과 개선 실험 |
| WF-15 | Governance and Change Control — 모든 핵심 변경 통제 |
| WF-16 | Final Command Center — 통합 진입점 (이 문서) |

각 문서는 `02_WORKFLOW/`에 있으며, 모두 "0.1 ASSET PATH MAPPING"으로 이 저장소의 실제 경로에 연결되어 있다.

## 3. 프로젝트 실행 방법

Claude Code 세션에서 자연어 명령을 입력한다. 예: `Content OS 전체 실행`. 명령은 `01_SYSTEM/COMMAND_ROUTER.md`가 적절한 Workflow로 라우팅한다. 개별 Workflow 파일을 직접 열어 실행할 필요는 없다.

## 4. 최초 설정 방법

`Content OS 초기화`를 실행하면 누락된 폴더/Config/Registry를 안전 기본값으로 생성한다 (기존 파일은 덮어쓰지 않음). `04_INPUT/publication_config.yaml`, `wordpress_config.yaml`은 이미 안전 기본값(자동 공개 비활성)으로 존재한다.

## 5. Keyword 입력 방법

`04_INPUT/keywords.csv`(형식은 `04_INPUT/WF-03_KEYWORDS_README.md` 참조)에 키워드를 추가한다. WF-03은 입력된 키워드만 처리하며 임의로 추가/삭제하지 않는다.

## 6. Reference 입력 방법

`04_INPUT/WF-01/reference_sites.md`에 분석할 참고 사이트를 등록한다. Rule/Pattern/Template 승격에는 동일 주제 2개 이상을 권장한다.

## 7. 전체 실행 명령

```text
Content OS 전체 실행
```

WF-09가 WF-01~WF-08을 Handoff 기준으로 순서대로 실행한다.

## 8. 특정 Keyword 실행 방법

```text
Content OS 키워드 실행: KW-0001
```

WF-03→04→05→06→07을 해당 키워드에 대해서만 실행한다.

## 9. WordPress 설정 방법

`04_INPUT/wordpress_config.yaml`에 `site.base_url`, `api_base_url`을 설정하고, 환경변수 `WP_USERNAME`, `WP_APPLICATION_PASSWORD`를 설정한다. 실제 비밀번호 값은 어떤 파일에도 기록하지 않는다.

## 10. WordPress 초안 생성 방법

```text
WordPress 초안 생성: KW-0001
```

WF-06 승인, WordPress Config 유효성, 인증 환경변수 존재가 모두 확인되어야 하며, 항상 Draft로만 생성된다. 자동 공개는 되지 않는다.

## 11. 품질 검수 기준

가중 점수 92점 이상, Critical 0건, Major 0건, 사실성/출처/독창성/정책/HTML 검수를 모두 통과해야 WF-07로 전달된다 (`01_SYSTEM/QUALITY_GATE.md` 참조).

## 12. 애드센스 결과 등록 방법

공식 결과(대시보드 상태, 공식 통지, 검증된 내보내기)를 `14_PERFORMANCE/intake/adsense/`에 넣는다. 예측이나 정황만으로는 승인/거절을 확정하지 않는다.

## 13. 승인 거절 대응 방법

```text
애드센스 거절 대응
```

WF-13이 공식/관찰/추론/미확인 근거를 분리하고, 확인된 문제만 담당 Workflow로 되돌린다. 애드센스 재신청은 자동 제출되지 않는다.

## 14. 성과 데이터 입력 방법

Search Console/Analytics/WordPress/AdSense 원본 데이터를 `14_PERFORMANCE/intake/`의 해당 하위 폴더에 넣는다. 존재하지 않는 지표는 `UNAVAILABLE`로 기록되며 추정하지 않는다.

## 15. 콘텐츠 최적화 방법

```text
콘텐츠 최적화 후보 탐지
```

충분한 관찰 데이터(최소 28일)가 있는 콘텐츠만 후보가 되며, 하나의 Optimization Experiment는 하나의 주요 가설만 시험한다.

## 16. 오류 복구 방법

```text
Content OS 복구
```

WF-09가 실패/차단 항목에 대한 복구 계획을 실행한다. 운영 복구는 `Content OS 운영 복구`(WF-11), WordPress 동기화 재시도는 `WordPress 동기화 재시도`(WF-07)를 사용한다.

## 17. 테스트 방법

```text
Content OS 빠른 테스트
Content OS 전체 테스트
```

WF-10이 `12_TEST/`의 격리된 환경에서 실행하며, 운영 데이터에 영향을 주지 않는다.

## 18. Governance 및 Version 관리

핵심 자산(Constitution, Content DNA, Rule/Template Library, Workflow, Quality Gate, Security/Publication Policy 등)의 변경은 WF-15를 거친다. 승인(`APPROVED_FOR_ROLLOUT`)과 배포(`RELEASED`)는 항상 분리되어 있으며, Sandbox → WF-10 테스트 → Limited Rollout을 통과해야 정식 반영된다. 현재 프로젝트 버전은 `1.0.0`(`06_MEMORY/WORKFLOW_LIBRARY/project_versions.json`)이다.

## 19. 보안 주의사항

WordPress 비밀번호, API Token, AdSense/Search Console/Analytics 인증정보는 절대 파일에 기록하지 않는다. 환경변수 이름만 Config에 기록한다 (`01_SYSTEM/SECURITY_POLICY.md` 참조).

## 20. 금지된 작업

애드센스 승인/재승인/수익/트래픽/순위 보장, 벤치마킹 콘텐츠 복제, 자동 Publish 기본 활성화, 자동 Delete, 자동 애드센스 신청/재신청, WF-06/WF-10 생략, Snapshot/Rollback 없는 변경, Governance 우회, 사용자에게 이미 알려진 정보 재질문, 다음 단계 임의 제안.

## 21. 주요 파일 위치

- 진입점: 저장소 루트 `CLAUDE.md`
- 헌법: `00_PROJECT_CONSTITUTION/CONSTITUTION.md`
- 시스템 파일: `01_SYSTEM/`
- Workflow 정의: `02_WORKFLOW/WF-01`~`WF-16`
- 영구 자산: `06_MEMORY/*_LIBRARY/` (18개)
- 실행 상태: `10_RUNTIME/`
- 통합 리포트: `11_REPORTS/`

## 22. 운영 명령 모음

전체 목록은 `11_REPORTS/COMMAND_REFERENCE.md` 참조.

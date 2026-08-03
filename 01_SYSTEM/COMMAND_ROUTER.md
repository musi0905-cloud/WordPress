# COMMAND ROUTER — Content OS

WF-16_FINAL_COMMAND_CENTER "9. COMMAND ROUTER", "10. COMMAND CONTEXT SCHEMA" 참조.

Command Router는 사용자의 자연어 명령을 실행 모드와 Workflow로 변환한다. 모든 명령은 `10_RUNTIME/command_context.json`의 스키마로 정규화된 뒤 라우팅된다.

## 1. PROJECT COMMANDS

| 명령 | 모드 | Workflow |
|---|---|---|
| `Content OS 초기화` / `프로젝트 초기화` / `Content OS 프로젝트 생성` | `INITIALIZE` | WF-16 → WF-10 |
| `Content OS 전체 실행` / `전체 프로세스 실행` / `모든 키워드 처리` | `FULL` | WF-09 controller → WF-01~WF-08 |
| `Content OS 이어서 실행` / `다음 단계 진행` / `계속 실행` | `CONTINUE` | WF-09 controller |
| `변경된 것만 실행` / `Content OS 변경분 실행` | `INCREMENTAL` | WF-09 controller |

`INITIALIZE` 수행 내용: 프로젝트 폴더 생성 / 기본 Config 생성 / Memory 및 Registry 초기화 / Workflow 파일 확인 / CLAUDE.md 생성 / Dry Run / Quick Validation

## 2. KEYWORD COMMANDS

| 명령 | Workflow |
|---|---|
| `Content OS 키워드 실행: KW-0001` / `키워드 처리: [키워드]` | WF-03 → WF-04 → WF-05 → WF-06 → WF-07 (`CONTENT_PIPELINE`) |
| `키워드 Brief 생성: KW-0001` | WF-03 |
| `콘텐츠 구조 생성: KW-0001` | WF-04 |
| `콘텐츠 작성: KW-0001` | WF-05 |
| `콘텐츠 검수: KW-0001` | WF-06 |

## 3. PUBLISHING COMMANDS

| 명령 | Workflow / 모드 |
|---|---|
| `Content OS 내보내기: KW-0001` | WF-07 / `EXPORT_ONLY` |
| `WordPress 초안 생성: KW-0001` / `Content OS WordPress 초안 생성` | WF-07 / `WORDPRESS_DRAFT` |
| `WordPress 동기화` / `미동기화 초안 동기화` | WF-07 / `SYNC_PENDING_DRAFTS` |

`WORDPRESS_DRAFT` 조건: WF-06 승인 / WordPress Config 유효 / 인증 환경변수 존재 / Category와 Author 해결 / 자동 Publish는 금지

## 4. OPERATIONS COMMANDS

| 명령 | Workflow / 모드 |
|---|---|
| `Content OS 운영 초기화` | WF-11 / `INITIALIZE` |
| `Content OS 운영 시작` | WF-11 / `START` |
| `Content OS 다음 Batch` | WF-11 / `NEXT_BATCH` |
| `Content OS 운영 일시 중단` | WF-11 / `PAUSE` |
| `Content OS 운영 재개` | WF-11 / `RESUME` |

## 5. PERFORMANCE COMMANDS

| 명령 | Workflow / 모드 |
|---|---|
| `Content OS 성과 분석` / `WF-12 전체 실행` | WF-12 / `FULL` |
| `색인 상태 분석` | WF-12 / `INDEXING` |
| `검색 성과 분석` | WF-12 / `SEARCH_PERFORMANCE` |
| `애드센스 상태 분석` / `애드센스 승인 결과 확인` | WF-12 / `ADSENSE` |

## 6. REMEDIATION COMMANDS

| 명령 | Workflow / 모드 |
|---|---|
| `애드센스 거절 대응` / `승인 거절 수정` | WF-13 / `ADSENSE_REJECTION` |
| `색인 문제 수정` | WF-13 / `INDEXING_REMEDIATION` |
| `저가치 콘텐츠 수정` | WF-13 / `LOW_VALUE_CONTENT` |
| `애드센스 재신청 준비 상태` | WF-13 / `REAPPLICATION_READINESS` |

애드센스 신청을 실제 제출하지 않는다.

## 7. OPTIMIZATION COMMANDS

| 명령 | Workflow / 모드 |
|---|---|
| `콘텐츠 최적화 후보 탐지` | WF-14 / `DETECT` |
| `콘텐츠 최적화: KW-0001` | WF-14 / `CONTENT` |
| `CTR 최적화` | WF-14 / `CTR` |
| `오래된 콘텐츠 갱신` | WF-14 / `FRESHNESS` |

## 8. GOVERNANCE COMMANDS

| 명령 | Workflow / 모드 |
|---|---|
| `변경 제안 수집` | WF-15 / `COLLECT` |
| `변경 제안 검토: CP-0001` | WF-15 / `REVIEW_PROPOSAL` |
| `변경안 Sandbox 테스트: CHG-0001` | WF-15 / `SANDBOX_TEST` |
| `프로젝트 버전 상태` / `Release 상태` | WF-15 / `VERSION_STATUS` |
| `Release Rollback: REL-0001` | WF-15 / `ROLLBACK` |

## 9. TEST COMMANDS

| 명령 | Workflow / 모드 |
|---|---|
| `Content OS 빠른 테스트` | WF-10 / `QUICK` |
| `Content OS 전체 테스트` | WF-10 / `FULL` |
| `Content OS E2E 테스트` | WF-10 / `END_TO_END` |
| `Content OS 보안 테스트` | WF-10 / `SECURITY` |
| `WordPress 안전 테스트` | WF-10 / `WORDPRESS_SAFETY` |

## 10. STATUS COMMANDS

| 명령 | 모드 |
|---|---|
| `Content OS 상태` / `프로젝트 상태` | `STATUS_ONLY` (WF-09/10/11/12/13/14/15 상태 취합) |
| `Content OS 차단 목록` | `BLOCKED_ITEMS` |
| `Content OS 수동 검토 목록` | `MANUAL_REVIEW_ITEMS` |
| `Content OS 운영 상태` | WF-11 / `STATUS` |

## 11. RECOVERY COMMANDS

| 명령 | Workflow / 모드 |
|---|---|
| `Content OS 복구` | WF-09 / `RECOVERY` |
| `Content OS 운영 복구` | WF-11 / `RECOVERY` |
| `WordPress 동기화 재시도` | WF-07 / `RETRY_SYNC` |
| `실패 테스트 재실행` | WF-10 / `RETRY_FAILED` |

## COMMAND CONTEXT SCHEMA

모든 명령은 다음 구조로 변환되어 `10_RUNTIME/command_context.json`에 기록된다.

```yaml
schema_version: "1.0"

command_context:
  command_id:
  received_at:
  raw_command:
  normalized_command:
  command_category:
  execution_mode:

  scope:
    project:
    site_ids: []
    keyword_ids: []
    content_ids: []
    publication_ids: []
    case_ids: []
    experiment_ids: []
    proposal_ids: []
    changeset_ids: []
    release_ids: []

  routing:
    controller:
    workflows: []
    start_workflow:
    end_workflow:

  permissions:
    allow_file_changes:
    allow_wordpress_draft:
    allow_schedule:
    allow_publish:
    allow_delete:
    allow_adsense_submission:

  safety:
    require_quality_gate:
    require_test:
    require_snapshot:
    require_governance:
    require_manual_review:

  state:
    project_version:
    current_run:
    active_batch:
    active_incident:
    active_remediation:
    active_optimization:
    active_release:

  status:
  blocking_issues: []
```

이미 판단 가능한 정보(등록된 키워드, 설정된 WordPress 상태, 로그에 남은 오류 원인 등)는 사용자에게 다시 묻지 않는다. 필수 정보가 실제로 없고 자동 판단도 불가능한 경우에는 해당 기능만 차단하고 나머지 명령 처리는 계속한다.

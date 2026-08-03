# Content OS

## 1. Project Identity

이 프로젝트는 벤치마킹 사이트의 문장이나 콘텐츠를 복제하는 시스템이 아니다.

이 프로젝트는 검증된 사이트에서 추출한 구조적 Rule, Pattern, Template, Content DNA를 활용해 독창적이고 정확한 콘텐츠를 기획·작성·검수·배포·분석·개선하는 Content Operating System이다.

## 2. Primary Objective

- 사용자가 제공한 Keyword를 체계적으로 처리한다.
- Reference 사이트에서 구조적 원리를 추출한다.
- 독창적인 콘텐츠를 생성한다.
- 사실성과 출처를 검증한다.
- WordPress 게시 패키지 또는 Draft를 생성한다.
- 검색 및 애드센스 결과를 실제 데이터로 분석한다.
- 확인된 문제만 수정한다.
- 모든 변경을 Governance로 통제한다.

## 3. Absolute Rules

1. 사용자에게 이미 제공된 정보를 다시 묻지 않는다.
2. 다음 단계를 제안하지 않는다.
3. Reference 콘텐츠를 복제하지 않는다.
4. 확인되지 않은 사실을 만들지 않는다.
5. 가짜 경험, 후기, 전문가 의견을 만들지 않는다.
6. 애드센스 승인, 트래픽, 순위, 수익을 보장하지 않는다.
7. 검수되지 않은 콘텐츠를 배포하지 않는다.
8. 자동 Publish를 기본값으로 사용하지 않는다.
9. Secret과 인증정보를 출력하거나 저장하지 않는다.
10. 품질 및 보안 기준을 낮추지 않는다.
11. 변경은 Snapshot, Test, Rollback을 가져야 한다.
12. 핵심 변경은 WF-15 Governance를 거친다.

전체 10개조는 `01_SYSTEM/CORE_RULES.md`에 상세 정의되어 있다.

## 4. Workflow Map

- WF-01: Reference Analysis
- WF-02: Knowledge Engineering
- WF-03: Keyword Intelligence
- WF-04: Content Architecture
- WF-05: Content Generation
- WF-06: Quality Review
- WF-07: Export and Publishing
- WF-08: Project Learning
- WF-09: Master Orchestration
- WF-10: System Validation
- WF-11: Production Operations
- WF-12: Performance and Approval Intelligence
- WF-13: AdSense and Site Remediation
- WF-14: Content Optimization
- WF-15: Governance and Change Control
- WF-16: Final Command Center (이 파일을 포함해 위 15개 전체를 통합하는 최종 워크플로우)

각 문서는 `02_WORKFLOW/WF-01_REFERENCE_ANALYSIS.md` ~ `WF-16_FINAL_COMMAND_CENTER.md`에 있으며, 모두 하나의 문서만으로 독립 실행 가능하다.

## 5. Standard Execution Order

WF-01 → WF-02 → WF-03 → WF-04 → WF-05 → WF-06 → WF-07 → WF-08

WF-09 controls execution.

WF-10 validates the system.

WF-11 manages production.

WF-12 analyzes actual results.

WF-13 fixes confirmed problems.

WF-14 runs controlled optimization.

WF-15 governs project changes.

## 6. Default Behavior

When a user command is received:

1. Read Project Constitution (`00_PROJECT_CONSTITUTION/CONSTITUTION.md`).
2. Read this file (`CLAUDE.md`).
3. Detect project state (`10_RUNTIME/workflow_state.json`).
4. Load Command Router (`01_SYSTEM/COMMAND_ROUTER.md`).
5. Determine execution mode.
6. Validate dependencies (`10_RUNTIME/dependency_graph.json`).
7. Build execution queue.
8. Execute only eligible workflows.
9. Validate output and handoff (`01_SYSTEM/HANDOFF_POLICY.md`).
10. Save state and logs.
11. Report the result.

Command examples: `Content OS 초기화`, `Content OS 전체 실행`, `Content OS 키워드 실행: KW-0001`, `WordPress 초안 생성: KW-0001`, `Content OS 성과 분석`, `애드센스 거절 대응`, `콘텐츠 최적화 후보 탐지`, `Content OS 전체 테스트`, `Content OS 상태`, `Content OS 운영 상태`, `Content OS 복구`, `변경 제안 검토: CP-0001`. Full reference: `11_REPORTS/COMMAND_REFERENCE.md`.

## 7. Default Publishing Safety

- Default mode: EXPORT_ONLY or WORDPRESS_DRAFT
- Auto Publish: disabled
- Auto Schedule: disabled
- Delete: disabled
- Redirect: manual review
- Noindex: manual review
- AdSense application: manual only
- AdSense reapplication: manual only

## 8. Quality Gate

No content may proceed to WF-07 unless:

- WF-06 score is at least 92
- Critical issues = 0
- Major issues = 0
- High-risk facts are verified
- Policy status is passed
- Source package is valid
- Markdown and HTML are consistent

Full detail: `01_SYSTEM/QUALITY_GATE.md`.

## 9. Reporting

At completion report only:

- Run ID
- Command
- Execution mode
- Workflow states
- Processed items
- Created and updated files
- Quality results
- WordPress results
- Blocking issues
- Recovery requirements
- Final status

## 10. Repository-Specific Notes

This repository is the Content OS project — an AI content operating system built as a chain of 16 independently executable workflow specifications, not application code.

Every workflow document under `02_WORKFLOW/` opens with a `0.1 ASSET PATH MAPPING` section that resolves any path the document assumes to this repo's actual nested layout (e.g. `06_MEMORY/rule_library.json` → `06_MEMORY/RULE_LIBRARY/RULES.md`) — read that before assuming a referenced path doesn't exist.

Do not write blog content, call the WordPress API, or modify Rule/Pattern/Template libraries outside of running the relevant workflow as specified — this project's core discipline (see the Constitution's Operating Principles) is that every asset is produced by a specific workflow under specific constraints, not ad hoc.

Further reading:

- `01_SYSTEM/` — System Prompt, Core Rules, Quality Gate, Error Policy, Command Router, State Machine, Security Policy, Handoff Policy
- `README.md` — project structure, pipeline overview, per-workflow usage instructions
- `11_REPORTS/PROJECT_HANDOVER.md` — full operator handover document
- `11_REPORTS/COMMAND_REFERENCE.md` — complete command list by category
- `11_REPORTS/FINAL_SYSTEM_REPORT.md` — current integration status of WF-01~WF-16

## 11. Development Operating Agreement (2026-08-03~)

이 저장소에서의 개발 협업은 다음 역할 분담으로 진행한다.

- **사용자 (Product Owner)**: 목표 결정, 실 데이터 제공(키워드/레퍼런스/WordPress/Search Console/AdSense), 결과 검토, Publish/Sprint 승인, GitHub 관리(Commit/Push/Release/Issue). Python, Workflow, Registry, Constitution을 직접 수정하지 않는다.
- **Claude (Lead AI Developer, 이 세션)**: Workflow/Python/Browser Agent/WordPress 연동/Registry/Memory/CLI 구현, 버그 수정, 테스트(Mock→Dry Run→Real Test), 문서화. Constitution과 Workflow를 준수하며 구현 세부사항은 자율적으로 결정하되, Rule/Pattern/Template/Workflow/Schema/Config/Policy 등 핵심 자산 변경은 WF-15 Governance를 거친다(3.2, 3.8 원칙).
- **ChatGPT (외부, CTO/AI Architect)**: 기술 방향·아키텍처·Workflow 개선·Prompt 설계·SEO/애드센스 전략 검토. 이 세션 밖에서 진행되며 이 세션이 직접 관여하지 않는다.

**작업 완료 보고 형식**: 본 섹션 채택 이후, 작업 단위(Sprint) 완료 시 Section 9 보고 항목을 아래 형식으로 대체한다(Section 9의 항목을 포함하는 상위 호환 형식).

```
[현재 Sprint] 목표 / 진행률 / 완료한 작업 / 생성 파일 / 수정 파일 / 테스트 결과 /
발견한 문제 / 원인 / 해결 방법 / 사용자가 해야 하는 일 / 다음 Sprint / 예상 소요시간
```

**Sprint 운영 규칙**: 한 번에 하나의 Sprint만 진행하며, 완료 전 다음 Sprint를 시작하지 않는다. Product Owner 입력이 필요하면 즉시 멈추고 필요한 항목만 요청한다(추측 금지).

**자동화 허용 범위** (Section 7 Default Publishing Safety와 일치, 추가 확장 없음): Browser Agent, Reference Analysis, Keyword Analysis, Content Generation, Quality Review, Export, WordPress Draft — 허용. Auto Publish, Delete, Schedule Publish, AdSense 자동 신청, Search Console 자동 수정, Theme/Plugin 변경 — 금지.

**알려진 제약**: Browser Agent(자동 레퍼런스 수집)는 이 클라우드 세션(Claude Code on the web)에서 실행 불가 — 세션 네트워크 정책이 임의 외부 사이트 접근을 차단하며(naver.com, wordpress.org, wikipedia.org 등에서 curl/WebFetch/사내 Chromium 모두로 확인됨), 이는 우회 대상이 아닌 조직 정책 거부다. Browser Agent 구현·실행·테스트는 사용자 로컬 PC의 Claude Code + Claude in Chrome 세션에서 진행하며, 산출물(Rule/Pattern/Template/Memory 갱신)은 동일 GitHub 저장소를 통해 이 세션과 공유된다.

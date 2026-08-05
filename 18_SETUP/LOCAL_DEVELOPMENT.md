# Local Development Environment

Sprint 1 산출물. 목표: 이 GitHub 저장소를 **로컬 PC의 Claude Code CLI**에서 완전히 실행 가능한 상태로 만들고, Browser Agent(Sprint 2 이후)를 개발할 수 있는 토대를 갖춘다.

이 문서는 개요이며, OS별 설치는 `WINDOWS_SETUP.md`, 브라우저 연동은 `CHROME_SETUP.md`, Git/GitHub 작업 흐름은 `GITHUB_WORKFLOW.md`, 문제 해결은 `TROUBLESHOOTING.md`를 참조한다.

## 1. 왜 로컬 환경이 필요한가

이 세션(Claude Code on the web)은 클라우드 컨테이너에서 실행되며, 아래가 구조적으로 불가능하다는 것이 이미 여러 차례 확인되었다.

- 임의 외부 사이트 접근(WebFetch/curl) — 세션 네트워크 정책이 차단 (naver.com, wordpress.org, wikipedia.org 등에서 확인됨)
- 사용자의 실제 Chrome 브라우저 제어 — Claude in Chrome 확장은 로컬 `claude` CLI 프로세스와만 페어링됨

Browser Agent(레퍼런스 자동 수집), WordPress 실제 게시 확인 등은 로컬 환경에서만 진행할 수 있다.

## 2. 목표 구성

```
PC
├── Claude Code (CLI, 로컬 실행)
├── Chrome + Claude in Chrome (브라우저 제어)
├── WordPress (실 사이트, 관리자 접근)
└── Git (버전관리)

           ↓  git pull / push

GitHub (musi0905-cloud/wordpress)
├── 02_WORKFLOW ~ 17_GOVERNANCE  — 프로젝트 문서, Registry, Memory
└── 18_SETUP                    — 이 문서들
```

## 3. 사전 요구사항 요약

| 항목 | 최소 버전 | 확인 명령 | 상세 |
|---|---|---|---|
| Git | 2.x | `git --version` | `GITHUB_WORKFLOW.md` |
| Node.js | 18 LTS 이상 | `node --version` | `WINDOWS_SETUP.md` |
| npm | Node에 포함 | `npm --version` | `WINDOWS_SETUP.md` |
| Claude Code CLI | 최신 | `claude --version` | `WINDOWS_SETUP.md` |
| Chrome | 최신 | — | `CHROME_SETUP.md` |
| Claude in Chrome 확장 | 최신 | — | `CHROME_SETUP.md` |

Claude Code CLI의 정확한 설치 명령/UI는 버전에 따라 바뀔 수 있으므로, 이 문서들의 안내와 함께 공식 문서(https://docs.claude.com/en/docs/claude-code)를 최종 확인 기준으로 삼는다. 이 프로젝트 문서가 실제 화면과 다르면 공식 문서가 우선한다.

## 4. 설치 순서 (요약)

1. Git 설치 및 사용자 정보 설정 (`GITHUB_WORKFLOW.md` 1절)
2. Node.js 설치 (`WINDOWS_SETUP.md` 1절)
3. Claude Code CLI 설치 및 로그인 (`WINDOWS_SETUP.md` 2절)
4. 이 저장소 clone, 작업 브랜치로 checkout (`GITHUB_WORKFLOW.md` 2절)
5. `claude`로 저장소 열어 프로젝트가 정상 인식되는지 확인 (`CLAUDE.md`가 자동 로드되는지)
6. Chrome + Claude in Chrome 설치 및 페어링 (`CHROME_SETUP.md`)
7. 환경변수 설정 (5절, 값은 저장소에 저장하지 않음)
8. 이 문서 6절 체크리스트로 검증

## 5. 필요한 환경변수 (이름만 — 실제 값은 저장소에 절대 저장하지 않음)

| 변수명 | 용도 |
|---|---|
| `ANTHROPIC_API_KEY` | Claude Code CLI를 API Key 방식으로 인증할 경우 (OAuth 로그인을 쓰면 불필요) |
| `WP_BASE_URL` | 연동할 WordPress 사이트 주소 |
| `WP_USERNAME` | WordPress 자동화 전용 계정 아이디 |
| `WP_APPLICATION_PASSWORD` | WordPress Application Password (일반 로그인 비밀번호 아님) |

- 로컬에서는 `.env` 파일 등에 저장하고, 저장소 루트 `.gitignore`에 `.env`, `.env.*`, `*.secret`, `secrets/`, `credentials/`가 이미 등록되어 있어 실수로 커밋되지 않는다.
- WordPress Application Password 발급 절차와 권한 범위는 이후 WordPress 연동 Sprint에서 별도로 안내한다(이번 Sprint 범위 아님).
- `git status`, `git add` 전에 항상 위 항목이 스테이징에 포함되지 않았는지 확인한다.

## 6. Sprint 1 종료 조건 (체크리스트)

- [ ] Git 설치 확인 (`git --version`)
- [ ] Node.js 설치 확인 (`node --version`, `npm --version`)
- [ ] Claude Code CLI 설치 확인 (`claude --version`, `claude doctor` 정상)
- [ ] GitHub 연결 확인 (이 저장소 clone 성공, 작업 브랜치 checkout 성공)
- [ ] 프로젝트 정상 인식 (`claude` 실행 시 `CLAUDE.md` 로드 확인)
- [ ] Chrome 연결 확인 (Claude in Chrome 확장 설치 및 페어링)
- [ ] Browser Agent 실행 가능 여부 확인 (Claude가 Chrome 탭을 열고 페이지를 읽을 수 있는지 최소 테스트)
- [ ] WordPress 연결 준비 (사이트 URL 확보, Application Password 발급 절차 숙지 — 실제 연동은 이번 Sprint 범위 아님)
- [ ] 환경변수 설정 (이름만 — 위 5절 4개 변수, 로컬에만 저장)

아래 명령이 모두 성공하면 이 Sprint는 완료 상태다.

```bash
claude --version
claude doctor
claude
```

체크리스트 항목 중 실패하는 것이 있으면 `TROUBLESHOOTING.md`를 먼저 확인하고, 해결되지 않으면 어떤 단계에서 무엇이 실패했는지(에러 메시지 포함) 알려준다 — Claude(로컬 세션)가 원인을 분석하고 문서를 갱신한다.

## 7. 이후 Sprint와의 관계

이 Sprint에서는 Browser Agent를 구현하지 않는다. 이 환경이 검증된 후 Sprint 2(Browser Agent) → Sprint 3(Reference Collector) → Sprint 4(Keyword Intelligence, 100개) → Sprint 5(Validation Batch, 5개) 순서로 진행한다.

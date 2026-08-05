# Troubleshooting — Local Development Environment

증상별로 정리했다. 여기 없는 문제가 발생하면, 정확한 에러 메시지와 실행한 명령을 그대로 로컬 `claude` 세션에 붙여넣어 진단을 요청한다 — Claude(로컬 세션)가 원인을 분석하고 필요하면 이 문서에 새 항목을 추가한다.

## Git

**"git: command not found" / "'git'은(는) 내부 또는 외부 명령... 아님"**
Git이 설치되지 않았거나 PATH에 없다. `WINDOWS_SETUP.md` 1절대로 재설치 후 새 터미널을 연다.

**clone 시 인증 오류 (403 / Permission denied)**
- HTTPS로 clone했다면 GitHub 로그인 정보 또는 Personal Access Token이 필요할 수 있다. GitHub 계정 인증 상태를 확인한다.
- 저장소 접근 권한이 있는 계정으로 로그인했는지 확인한다.

**push 시 "rejected — non-fast-forward"**
원격에 로컬에 없는 새 커밋이 있다는 뜻이다(웹 세션이 먼저 push했을 가능성). `git pull origin claude/content-os-constitution-o69om2`로 먼저 받은 뒤 다시 push한다. 충돌이 나면 `GITHUB_WORKFLOW.md` 7절대로 처리한다.

## Node.js / npm

**Node 버전이 너무 낮다는 오류**
`node --version`으로 확인 후 18 미만이면 https://nodejs.org 에서 최신 LTS로 재설치한다. 기존 버전 제거 없이 설치해도 대부분 최신 버전으로 덮어써진다.

**npm install 중 권한 오류(EACCES 등)**
Windows에서는 보통 발생하지 않는다. 발생 시 PowerShell을 관리자 권한으로 다시 열고 재시도한다.

**npm install이 네트워크 오류로 멈춤**
회사/기관 네트워크의 방화벽이나 프록시가 npm 레지스트리(registry.npmjs.org) 접근을 막고 있을 수 있다. 개인 네트워크(가정용 Wi-Fi 등)에서 재시도해본다.

## Claude Code CLI

**"claude: command not found"**
npm 전역 설치 경로가 시스템 PATH에 없는 경우다.

```powershell
npm config get prefix
```

위 명령으로 나온 경로 + `\` (Windows) 또는 `/bin` (macOS/Linux)를 시스템 PATH 환경변수에 추가하고 새 터미널을 연다.

**`claude doctor`에서 인증 관련 경고**
`WINDOWS_SETUP.md` 4절대로 로그인(OAuth) 또는 `ANTHROPIC_API_KEY` 설정을 다시 확인한다. 환경변수를 `setx`로 설정했다면 반드시 **새 터미널**에서 확인해야 반영된다.

**`claude` 실행 시 이 프로젝트의 `CLAUDE.md`를 인식하지 못함**
저장소 루트 폴더(즉 `CLAUDE.md`가 있는 위치)에서 `claude`를 실행했는지 확인한다. 하위 폴더에서 실행하면 프로젝트 컨텍스트를 못 찾을 수 있다.

## PowerShell

**"이 시스템에서 스크립트를 실행할 수 없으므로..." (실행 정책 오류)**
관리자 권한 PowerShell에서:

```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

## Windows 호환성

**경로에 한글/공백이 포함되어 오류 발생**
저장소를 영문·공백 없는 경로(예: `C:\dev\wordpress`)에 clone하는 것을 권장한다.

**경로 길이 제한(260자) 오류**
Windows 10/11에서는 그룹 정책 또는 레지스트리로 긴 경로를 허용할 수 있다(관리자 권한 필요). 우선은 저장소를 드라이브 루트에 가깝게(`C:\dev\...`) clone해서 회피하는 것을 권장한다.

## Chrome / Claude in Chrome

**확장을 설치했는데 로컬 `claude` CLI와 연결되지 않음**
- Chrome을 완전히 재시작한다.
- `claude` CLI가 최신 버전인지 확인한다(`npm install -g @anthropic-ai/claude-code`로 재설치하면 최신화됨).
- 확장이 Anthropic 공식 발행자가 맞는지 Chrome 웹 스토어에서 다시 확인한다.

**브라우저 제어 테스트(페이지 열기)는 되는데 특정 사이트만 안 열림**
사이트 자체의 접근 제한(로그인 필요, 지역 제한 등)일 수 있다 — 이 세션(로컬)은 사용자 PC 네트워크를 그대로 쓰므로, 웹 클라우드 세션에서 겪었던 조직 egress 차단과는 무관한 문제다. 브라우저에서 직접 열어봤을 때도 안 열리는지 먼저 확인한다.

## FAQ

**Q. 웹 Claude Code 세션과 로컬 세션을 동시에 켜놓고 작업해도 되나?**
가능하지만 같은 파일을 동시에 수정하면 git 충돌이 날 수 있다. 가능하면 한 번에 한쪽에서만 작업하고, 작업 전후로 반드시 pull/push해서 동기화한다.

**Q. `ANTHROPIC_API_KEY`와 Claude.ai 로그인 중 뭘 써야 하나?**
개인/소규모 사용은 Claude.ai 로그인(OAuth)이 더 간단하다. 조직 단위 API 과금·관리가 필요한 경우에만 API Key 방식을 쓴다.

**Q. WordPress Application Password는 언제 만드나?**
이번 Sprint(로컬 환경 구축) 범위가 아니다. WordPress 연동 Sprint에서 별도로 안내한다 — 이번에는 `WP_BASE_URL`/`WP_USERNAME`/`WP_APPLICATION_PASSWORD` 변수명만 파악해두면 된다.

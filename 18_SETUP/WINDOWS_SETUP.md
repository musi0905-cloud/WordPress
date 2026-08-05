# Windows Setup — Git, Node.js, Claude Code CLI

`LOCAL_DEVELOPMENT.md`의 3~4절(설치 순서)을 Windows 기준으로 구체화한 문서다. macOS/Linux를 쓰는 경우 이 문서의 Windows 전용 항목(PowerShell 실행 정책 등)만 건너뛰면 된다.

## 1. Git 설치

1. https://git-scm.com/download/win 에서 설치 파일을 받아 실행한다.
2. 설치 옵션은 기본값으로 진행해도 무방하다(줄바꿈 처리, 기본 에디터 등은 취향에 따라 조정 가능).
3. 설치 후 새 터미널(PowerShell 또는 Git Bash)을 열고 확인한다.

```powershell
git --version
```

4. 최초 1회, 커밋 작성자 정보를 설정한다.

```powershell
git config --global user.name "실제 이름 또는 GitHub 아이디"
git config --global user.email "musi0905@gmail.com"
```

## 2. Node.js 설치

1. https://nodejs.org 에서 **LTS** 버전(18 이상)을 받아 설치한다.
2. 설치 후 확인한다.

```powershell
node --version
npm --version
```

버전이 18 미만이면 Claude Code CLI가 정상 동작하지 않을 수 있다 — Node.js를 최신 LTS로 업데이트한다.

## 3. Claude Code CLI 설치

```powershell
npm install -g @anthropic-ai/claude-code
```

설치 후 확인한다.

```powershell
claude --version
claude doctor
```

`claude doctor`는 설치 상태(Node 버전, PATH, 인증 상태 등)를 점검해주는 진단 명령이다. 여기서 나오는 경고/오류는 `TROUBLESHOOTING.md`를 먼저 확인한다.

## 4. 로그인 / 인증

두 가지 방식 중 하나를 사용한다.

**A. Claude.ai 계정으로 로그인 (권장, 대부분의 경우)**

```powershell
claude
```

최초 실행 시 브라우저 로그인 창이 뜬다. Claude(claude.ai) 계정으로 로그인하면 별도 API Key 설정 없이 사용 가능하다.

**B. API Key로 인증 (조직에서 API Key 발급이 필요한 경우)**

환경변수 `ANTHROPIC_API_KEY`를 설정한다(실제 키 값은 이 저장소나 어떤 파일에도 커밋하지 않는다).

```powershell
setx ANTHROPIC_API_KEY "여기에_실제_키"
```

`setx`는 새 터미널부터 적용된다. 현재 터미널에서 바로 테스트하려면 `$env:ANTHROPIC_API_KEY="..."`로 세션 한정 설정도 가능하다.

## 5. 저장소 열기

`GITHUB_WORKFLOW.md`대로 저장소를 clone한 뒤, 해당 폴더에서:

```powershell
cd 저장소_경로\WordPress
claude
```

`claude`가 `CLAUDE.md`를 자동으로 읽어들이고 프로젝트 컨텍스트를 인식하면 정상이다.

## 6. PowerShell 관련 주의사항

- 스크립트 실행이 차단되는 경우(`실행 정책` 오류): 관리자 권한 PowerShell에서 아래 실행 후 재시도한다.

```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

- `claude` 명령을 찾을 수 없다는 오류가 나오면 npm 전역 설치 경로가 PATH에 없는 경우다 — `TROUBLESHOOTING.md`의 PATH 항목 참조.
- 한글 경로(예: 사용자 폴더명에 한글 포함)에서 일부 npm 패키지가 오류를 낼 수 있다 — 문제가 발생하면 영문 경로(예: `C:\dev\WordPress`)로 clone하는 것을 권장한다.

## 7. 완료 확인

아래가 모두 통과하면 이 문서의 범위는 완료다. 이어서 `CHROME_SETUP.md`로 진행한다.

```powershell
git --version
node --version
npm --version
claude --version
claude doctor
```

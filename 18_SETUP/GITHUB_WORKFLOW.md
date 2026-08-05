# GitHub Workflow — Clone, Branch, Daily Cycle

## 1. Clone

작업 브랜치는 `claude/content-os-constitution-o69om2`다. 이 세션(웹)의 모든 작업이 이 브랜치에 올라가 있으므로, 로컬에서도 동일 브랜치로 작업한다.

```bash
git clone https://github.com/musi0905-cloud/wordpress.git
cd wordpress
git checkout claude/content-os-constitution-o69om2
git pull origin claude/content-os-constitution-o69om2
```

이미 clone된 폴더가 있다면 clone 대신 아래로 최신화한다.

```bash
git fetch origin claude/content-os-constitution-o69om2
git checkout claude/content-os-constitution-o69om2
git pull origin claude/content-os-constitution-o69om2
```

## 2. 매 작업 시작 전 — 항상 pull

```bash
git pull origin claude/content-os-constitution-o69om2
```

이 웹 세션과 로컬 세션이 같은 브랜치를 공유하므로, 로컬에서 작업을 시작하기 전에 웹 세션 쪽 최신 커밋을 먼저 받아야 충돌을 피할 수 있다.

## 3. 하루 작업 사이클

```
git pull
     ↓
Claude Code (로컬)에게 작업 지시
     ↓
Claude가 코드/문서/Registry 수정
     ↓
git status로 변경 파일 확인
     ↓
git add <구체적 파일>   (git add -A 지양)
     ↓
git commit -m "..."
     ↓
git push origin claude/content-os-constitution-o69om2
```

## 4. 커밋 전 필수 확인

- `git status`로 스테이징될 파일 목록을 반드시 확인한다.
- `.env`, `*.secret`, `secrets/`, `credentials/` 등 실제 인증정보 파일이 포함되지 않았는지 확인한다(`.gitignore`에 이미 등록되어 있지만, 이름이 다른 새 파일을 만들었다면 별도 확인 필요).
- 파일명이 무해해 보여도 내용에 API Key나 비밀번호가 포함되지 않았는지 의심되면 열어서 확인한다.

## 5. 커밋 메시지 컨벤션

이 프로젝트(웹 세션)에서 지금까지 써온 방식을 따른다 — 무엇을 바꿨는지보다 **왜** 바꿨는지 중심으로 간결하게 작성한다.

```
<한 줄 요약, 현재형 동사로 시작>

<선택: 본문 — 배경/이유, 특히 사용자가 나중에 "왜 이렇게 했지"를 알아야 하는 경우>
```

## 6. Push 관련 주의사항

- `git push -u origin claude/content-os-constitution-o69om2` 형태로 최초 1회 upstream을 설정하면 이후 `git push`만으로 충분하다.
- `--force`(강제 푸시)는 이 프로젝트에서 사용하지 않는다. 웹 세션과 로컬 세션이 같은 브랜치를 함께 쓰기 때문에, 강제 푸시는 다른 쪽 작업을 덮어쓸 위험이 크다.
- push 전에 원격에 새 커밋이 있는지 `git fetch` + `git status`로 먼저 확인하는 습관을 들인다(웹 세션이 먼저 push했을 수 있음).

## 7. 웹 세션과 로컬 세션이 동시에 작업할 때

- 웹 세션에서 작업 중이면, 로컬에서 작업을 시작하기 전에 사용자가 웹 세션 쪽 작업이 끝났는지(커밋/푸시 완료) 먼저 확인하는 것을 권장한다.
- 두 세션이 동시에 같은 파일을 수정하면 일반적인 git merge conflict가 발생할 수 있다 — 이 경우 당황하지 말고 `git status`로 충돌 파일을 확인하고, 두 변경 내용을 비교해서 병합한다(임의로 한쪽을 버리지 않는다).

## 8. 완료 확인

- [ ] clone 성공, 작업 브랜치로 checkout 성공
- [ ] `git pull` 정상 동작
- [ ] 테스트용 변경 1건을 commit → push까지 성공 (예: 이 문서의 오탈자 수정 등 사소한 변경으로 사이클 검증)

# Chrome Setup — Claude in Chrome (Browser Agent 사전 준비)

이 문서는 로컬 Claude Code CLI가 사용자의 실제 Chrome 브라우저를 제어할 수 있도록 연결하는 절차를 다룬다. 이 연결이 되어야 Sprint 2(Browser Agent)에서 레퍼런스 사이트를 자동으로 열람·분석할 수 있다.

이번 Sprint의 목표는 "Browser Agent 완성"이 아니라 **"Chrome과 연결 가능한 상태 확인"**까지다.

## 1. 선행 조건

`WINDOWS_SETUP.md`를 완료해서 로컬에서 `claude` 명령이 정상 동작해야 한다.

## 2. Chrome 설치

이미 설치되어 있다면 건너뛴다. https://www.google.com/chrome/ 에서 최신 버전을 설치한다.

## 3. Claude in Chrome 확장 설치

1. Chrome에서 Chrome 웹 스토어(Chrome Web Store)로 이동한다.
2. "Claude"(Anthropic 제공) 확장 프로그램을 검색해 설치한다.
3. 확장이 요구하는 권한(활성 탭 읽기/제어 등)을 확인 후 허용한다.

> 확장 이름/설치 화면은 버전에 따라 바뀔 수 있다. 이 안내와 실제 화면이 다르면, 화면에 보이는 안내(Anthropic 공식 배포 확장인지 발행자 확인)를 우선한다.

## 4. 로컬 Claude Code CLI와 페어링

1. 저장소 폴더에서 `claude`를 실행한다(로그인 상태여야 한다 — `WINDOWS_SETUP.md` 4절).
2. Claude Code가 브라우저 제어 기능을 요청/활성화하는 안내(권한 프롬프트 또는 설정 메뉴)를 따른다.
3. 페어링이 완료되면 Chrome 확장 아이콘 또는 확장 팝업에 "연결됨" 상태가 표시된다(정확한 표시 문구는 버전에 따라 다를 수 있음).

## 5. 최소 연결 테스트

로컬 `claude` 세션에서 아래와 같이 요청해 브라우저 제어가 실제로 동작하는지 확인한다.

```
Chrome에서 예시로 아무 페이지나 하나 열어서 제목만 알려줘.
```

- Claude가 실제로 새 탭을 열고 페이지 제목을 읽어오면 **연결 성공** — `LOCAL_DEVELOPMENT.md` 체크리스트의 "Browser Agent 실행 가능 여부 확인" 항목을 완료로 표시한다.
- 실패하면 `TROUBLESHOOTING.md`의 Chrome 연동 항목을 확인한다.

## 6. 이번 Sprint에서 하지 않는 것

- naver.com 5개 레퍼런스 블로그의 실제 구조 분석 (Sprint 2/3에서 진행)
- Reference Collector 자동화 로직 구현 (Sprint 3)
- WordPress 실제 페이지 제어

이 문서의 목적은 "연결 가능함을 확인"하는 것까지이며, 실제 레퍼런스 분석 로직은 다음 Sprint에서 별도로 설계·구현한다.

## 7. 완료 확인

- [ ] Chrome 설치됨
- [ ] Claude in Chrome 확장 설치됨
- [ ] 로컬 `claude` CLI와 페어링됨
- [ ] 최소 연결 테스트(5절) 성공

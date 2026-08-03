# SECURITY POLICY — Content OS

WF-16_FINAL_COMMAND_CENTER "12.1 SECURITY POLICY STANDARD" 참조.

## 금지 항목 (어떤 산출물에도 기록하지 않는다)

- WordPress Password / Application Password
- API Token / Authorization Header
- Cookie / Session Token
- Database Password / Private Key
- AdSense Credential
- Search Console Credential
- Analytics Credential

## 허용 항목

- 환경변수 이름 (예: `WP_APPLICATION_PASSWORD`)
- 환경변수 존재 여부 (`true`/`false`)

## 원칙

- Secret은 코드·리포트·로그·Snapshot·Archive 어디에도 값 자체를 남기지 않는다.
- 자동 Publish, 자동 Schedule, 자동 Delete, 자동 AdSense 신청/재신청은 기본 비활성이며 명시적 권한과 검증 없이 활성화하지 않는다.
- WordPress Delete API는 어떤 Workflow에서도 호출하지 않는다.
- 운영 데이터와 테스트 데이터(`12_TEST/`)는 물리적으로 분리한다.
- 모든 신규 디렉터리는 커밋 전 Secret 노출 여부를 검사한다.
- Project Constitution, Security Policy 자체의 완화는 WF-15 Governance의 수동 승인 없이 적용하지 않는다.

이 정책은 WF-11(Operations), WF-12(Performance), WF-13(Remediation), WF-14(Optimization), WF-15(Governance) 각 문서의 개별 Security and Privacy Policy를 하나로 묶은 프로젝트 전역 기준이다. 개별 Workflow 문서의 조항이 더 구체적일 수 있으나, 이 문서의 원칙보다 낮은 기준을 허용하지 않는다.

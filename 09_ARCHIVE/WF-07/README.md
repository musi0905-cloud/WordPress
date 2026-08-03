# 09_ARCHIVE/WF-07

WF-07_EXPORT_AND_PUBLISHING을 재실행할 때, 최종 콘텐츠·메타데이터·Schema·미디어·내부링크 해석 결과가 변경되어 기존 Export Package가 갱신되는 경우 이전 버전을 보관한다.

경로 규칙: `09_ARCHIVE/WF-07/<timestamp>/` (12. IDEMPOTENCY AND VERSION CONTROL 참조)

기존 WordPress Post ID가 있는 경우 새 Post를 생성하지 않고 업데이트하므로, 이 아카이브는 로컬 Export Package의 이력만 보관하며 WordPress 측 리비전은 별도로 관리되지 않는다.

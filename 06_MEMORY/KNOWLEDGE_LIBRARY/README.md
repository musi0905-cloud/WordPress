# KNOWLEDGE LIBRARY

프로젝트의 지식 체계 — Rule Library / Pattern Library / Template Library를 압축·구조화한 상위 자산을 보관한다.

이 디렉토리는 `WF-02_KNOWLEDGE_ENGINEERING`(02_WORKFLOW/WF-02_KNOWLEDGE_ENGINEERING.md)이 채운다.

| 파일 | 내용 |
|---|---|
| `CONTENT_DNA.md` | 프로젝트의 글쓰기 철학 (압축된 핵심 원칙). 이후 모든 워크플로우가 가장 먼저 조회하는 문서 |
| `DECISION_TREE.md` | 상황(콘텐츠 유형 등)별로 어떤 Rule/Pattern을 자동 적용할지 결정하는 트리 |
| `TEMPLATE_GRAPH.md` | Decision Tree 결과를 콘텐츠 유형별 완성 Template(CTPL-ID)으로 정리한 것 |
| `KNOWLEDGE_GRAPH.md` | Rule 간 관계 그래프 |
| `PATTERN_GRAPH.md` | Pattern 간 관계 그래프 |
| `CLASSIFICATION.md` | Rule/Pattern의 도메인 태그(SEO/UX/Trust 등) 매핑 |
| `VALIDATION_LOG.md` | Rule/Pattern/Template의 중복·충돌·우선순위·의존성 검증 결과 |

Rule 개수가 수천 개로 늘어나도 이 라이브러리, 특히 `CONTENT_DNA.md`와 `DECISION_TREE.md`는 안정적인 크기를 유지한다 — WF-03 이후의 워크플로우는 원칙적으로 Rule Library 전체가 아니라 이 라이브러리를 조회한다.

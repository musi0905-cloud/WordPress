# Generation Report — KW-0001 / DRAFT-0001

## 처리한 Blueprint

`05_OUTPUT/architecture/KW-0001_에어프라이어-고구마-굽는-법.yaml` (ARCH-0001, v1.0) — 7개 섹션 구조를 변경 없이 그대로 따름.

## 적용한 Rule

없음 — `06_MEMORY/RULE_LIBRARY/RULES.md`가 WF-01 미실행으로 비어 있어 인용 가능한 Rule ID가 존재하지 않음.

## 적용한 Content DNA

없음 — `06_MEMORY/KNOWLEDGE_LIBRARY/CONTENT_DNA.md`가 WF-02 미실행으로 Version 0 상태(미생성). Architecture 단계에서 직접 설계한 information_flow/trust_strategy를 대신 따름.

## 확인한 출처

5건 (`_sources.json` 참조, SRC-0001~SRC-0005). WebSearch로 2026-08-03에 직접 확인. 크기별 시간이 출처마다 25~55분으로 편차가 커서, 단일 값 대신 세 구간(작은/중간/큰)의 범위로 수렴시켜 서술함.

## 제외한 주장

- 냉동 고구마의 정확한 추가 조리 시간 (근거 부족)
- 건강·다이어트 효과 (근거 부족 및 정책 위험)
- 특정 브랜드 에어프라이어 비교 (Brief에서 애초에 제외)

## 작성 분량

Markdown 기준 약 7,356자, 7개 섹션, 표 1개, FAQ 3문항.

## 생성된 표·목록·FAQ

- 표: 크기별 온도·시간표 1개 (SEC-03)
- 순서 목록: 완성 확인법 3단계 (SEC-05)
- FAQ: 3문항 (SEC-07)

## 내부링크 상태

없음 — 저장소에 게시된 다른 콘텐츠가 없어(첫 스모크 테스트) 연결 대상이 존재하지 않음. `internal_link_markers: []`.

## 시각자료 상태

대표 이미지: `PENDING_ASSET` (Architecture visual_plan 참조). 본문 내 시각자료는 표로 대체.

## 검증 점수

WF-05 자체 self-check(STEP 17 상당) 기준:

```yaml
generation_quality:
  architecture_alignment: PASS
  title_preserved: PASS
  slug_preserved: PASS
  search_intent_alignment: PASS
  primary_objective_met: PASS
  outline_preserved: PASS
  required_points_covered: PASS
  prohibited_claims_avoided: PASS
  verified_facts_only: PASS
  source_markers_complete: PASS
  internal_link_markers_complete: PASS (해당 없음 — 후보 없음)
  visual_markers_complete: PASS (PENDING_ASSET로 명시)
  faq_alignment: PASS
  metadata_complete: PASS
  originality_check: PASS — 출처 문장을 그대로 옮기지 않고 종합·재구성함
  readability_check: PASS
  repetition_check: PASS
  html_validity: PASS
  score: 95
```

공식 품질 점수(92점 기준, Critical/Major 0건)는 WF-06에서 별도로 산정한다 — 위 점수는 WF-05 자체 점검 결과일 뿐이다.

## WF-06 전달 상태

`handoff.ready: true`, blocking_issues 없음. WF-06으로 진행 가능.

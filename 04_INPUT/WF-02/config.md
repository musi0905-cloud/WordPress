# WF-02 입력: 설정 (선택)

`WF-02_KNOWLEDGE_ENGINEERING`의 선택적 실행 설정. 이 파일이 없으면 워크플로우 문서에 정의된 기본값으로 실행된다.

```
target_content_types: Review, Comparison, Guide, Ranking, Definition, HowTo, FAQ
compression_mode: conservative
```

- `target_content_types`: Decision Tree/Template Graph가 우선 커버할 콘텐츠 유형
- `compression_mode`: `conservative`(명백한 중복만 병합) | `aggressive`(유사도 높은 항목까지 병합)

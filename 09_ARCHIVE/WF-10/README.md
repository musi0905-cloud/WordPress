# 09_ARCHIVE/WF-10

WF-10_SYSTEM_VALIDATION이 재실행될 때 대체되는 이전 테스트 산출물을 보관한다.

- `baselines/<timestamp>/` — 대체된 Regression Baseline (`06_MEMORY/VALIDATION_LIBRARY/regression_baseline.json`의 이전 버전)

테스트 산출물 자체(`12_TEST/`)는 운영 자산이 아니므로 원칙적으로 재실행마다 그대로 갱신되며, 별도 버전 보관이 필요한 것은 Baseline뿐이다.

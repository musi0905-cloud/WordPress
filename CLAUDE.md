# Content OS

This repository is the Content OS project — an AI content operating system built as a chain of independently executable workflow specifications, not application code.

Start here, in order:

1. `00_PROJECT_CONSTITUTION/CONSTITUTION.md` — the top-level governing document. All workflows are subordinate to it.
2. `02_WORKFLOW/WF-09_MASTER_ORCHESTRATION.md` — the entry point for running the whole system. Command: "Content OS 전체 실행" (or see its Command Behavior section for narrower modes: continue, resume, status, recovery, single-workflow, single-keyword).
3. `02_WORKFLOW/WF-01_REFERENCE_ANALYSIS.md` through `WF-08_PROJECT_LEARNING.md` — the individual pipeline stages WF-09 orchestrates. Each is independently runnable and documents its own required input/output.
4. `README.md` — project structure, pipeline overview, and per-workflow usage instructions.

Every workflow document under `02_WORKFLOW/` opens with a `0.1 ASSET PATH MAPPING` section that resolves any path the document assumes to this repo's actual layout — read that before assuming a referenced path doesn't exist.

Do not write blog content, call the WordPress API, or modify Rule/Pattern/Template libraries outside of running the relevant workflow as specified — this project's core discipline (see the Constitution's Operating Principles) is that every asset is produced by a specific workflow under specific constraints, not ad hoc.

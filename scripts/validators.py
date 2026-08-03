"""Environment validation and quality gate enforcement.

Mirrors the "STEP 01 ENVIRONMENT VALIDATION" pattern every WF-0X document
defines, and the Quality Gate defined in 01_SYSTEM/QUALITY_GATE.md
(minimum_score 92, critical_allowed 0, major_allowed 0).
"""
from __future__ import annotations

import re
from dataclasses import dataclass, field
from pathlib import Path

from file_utils import PROJECT_ROOT, now_iso, project_path, read_yaml, write_json

REQUIRED_ROOT_FILES = [
    "CLAUDE.md",
    "00_PROJECT_CONSTITUTION/CONSTITUTION.md",
]

REQUIRED_WORKFLOW_FILES = [f"02_WORKFLOW/WF-{i:02d}_*.md" for i in range(1, 17)]

DEFAULT_QUALITY_GATE = {
    "minimum_score": 92,
    "critical_allowed": 0,
    "major_allowed": 0,
}

# Files that must never contain a literal secret value (only *_env: names are allowed).
SECRET_SCAN_GLOBS = ["**/*.yaml", "**/*.yml", "**/*.json"]
SECRET_PATTERN = re.compile(
    r"(?i)(password|api[_-]?key|secret|token)\s*[:=]\s*['\"a-z0-9]"
)
SAFE_KEY_SUFFIX = re.compile(r"(?i)_env\s*:")


@dataclass
class ValidationResult:
    stage: str
    status: str = "PASSED"
    blocking_issues: list[str] = field(default_factory=list)
    warnings: list[str] = field(default_factory=list)

    @property
    def passed(self) -> bool:
        return self.status == "PASSED" and not self.blocking_issues


def validate_environment(stage: str, required_paths: list[str]) -> ValidationResult:
    """Generic STEP 01-style check: project root, constitution, and this
    stage's specific required upstream files/dirs all present."""
    result = ValidationResult(stage=stage)

    if not project_path("CLAUDE.md").exists():
        result.blocking_issues.append("CLAUDE.md missing at project root")
    if not project_path("00_PROJECT_CONSTITUTION/CONSTITUTION.md").exists():
        result.blocking_issues.append("00_PROJECT_CONSTITUTION/CONSTITUTION.md missing")

    for rel in required_paths:
        if not project_path(rel).exists():
            result.blocking_issues.append(f"required path missing: {rel}")

    if result.blocking_issues:
        result.status = "BLOCKED"

    log_dir = project_path("08_LOG", stage)
    write_json(log_dir / "environment_validation.json", {
        "stage": stage,
        "checked_at": now_iso(),
        "status": result.status,
        "blocking_issues": result.blocking_issues,
        "warnings": result.warnings,
    })
    return result


def load_quality_gate_config() -> dict:
    cfg = read_yaml(project_path("04_INPUT", "project_config.yaml"))
    if not cfg or "quality" not in cfg:
        return dict(DEFAULT_QUALITY_GATE)
    quality = cfg["quality"]
    return {
        "minimum_score": quality.get("minimum_score", DEFAULT_QUALITY_GATE["minimum_score"]),
        "critical_allowed": quality.get("critical_allowed", DEFAULT_QUALITY_GATE["critical_allowed"]),
        "major_allowed": quality.get("major_allowed", DEFAULT_QUALITY_GATE["major_allowed"]),
    }


def check_quality_gate(quality_report: dict) -> tuple[bool, list[str]]:
    """quality_report must have: weighted_score (int|None), critical_issues (int),
    major_issues (int). Returns (passed, reasons_if_blocked)."""
    gate = load_quality_gate_config()
    reasons: list[str] = []

    score = quality_report.get("weighted_score")
    critical = quality_report.get("critical_issues")
    major = quality_report.get("major_issues")

    if score is None or critical is None or major is None:
        reasons.append(
            "quality_report is incomplete (weighted_score/critical_issues/major_issues "
            "not yet produced by real content review) — cannot pass the gate"
        )
        return False, reasons

    if score < gate["minimum_score"]:
        reasons.append(f"weighted_score {score} < minimum_score {gate['minimum_score']}")
    if critical > gate["critical_allowed"]:
        reasons.append(f"critical_issues {critical} > allowed {gate['critical_allowed']}")
    if major > gate["major_allowed"]:
        reasons.append(f"major_issues {major} > allowed {gate['major_allowed']}")

    return (len(reasons) == 0), reasons


def scan_for_secret_exposure(root: Path = PROJECT_ROOT) -> list[str]:
    """Best-effort static check: flags 'password:', 'api_key:', 'token:' etc.
    followed directly by a quoted/alphanumeric value, while allowing the
    project's own convention of '<name>_env: ENV_VAR_NAME'."""
    hits: list[str] = []
    for pattern in SECRET_SCAN_GLOBS:
        for path in root.glob(pattern):
            if any(part.startswith(".") for part in path.parts):
                continue
            try:
                text = path.read_text(encoding="utf-8", errors="ignore")
            except OSError:
                continue
            for lineno, line in enumerate(text.splitlines(), start=1):
                if SAFE_KEY_SUFFIX.search(line):
                    continue
                if SECRET_PATTERN.search(line):
                    hits.append(f"{path.relative_to(root)}:{lineno}")
    return hits

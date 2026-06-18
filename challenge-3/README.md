# Challenge 3 — Show us what you got

For this challenge the deliverable isn't new code in this repo — it's the
**complete git history of a past project I'm proud of**, meeting the brief's
criteria: **sole author · started within the last 3 years · my best work.**

## Project: GW Custom Blocks — `gw-core`

🔗 **https://github.com/LuigiLibet/gw-core** — public, full commit history.

GW Custom Blocks is a from-scratch WordPress block framework: a small API
(`gw_register_block()`) for registering **dynamic, server-rendered (PHP) blocks**
with auto-discovered render templates and **auto-generated inspector controls**.
It's the very engine that powers the custom blocks in **Challenge 1**
(`challenge-1/theme/gw/`).

### Why it fits the brief
- **Sole author** — every commit is mine. A committed `.mailmap` unifies my two git
  identities ("Luis Castillo" and "LuigiLibet") into one; the only other committer is
  a `github-actions` bot that auto-updates the release manifest.
- **Started within 3 years** — first commit `2025-12-06`.
- **Best work** — a real, versioned framework (releases through v1.3.x) with a clean,
  descriptive, atomic commit history that shows the project's evolution.

### What to look at
- `git log` / `git shortlog -sne` — clean, descriptive, atomic commits, single author.
- `gw-custom-blocks/` — the registration API + inspector-control generation.
- Release automation — versioned `manifest.json` + GitHub Actions.

> Tip: clone and run `git shortlog -sne` to see the unified single-author history
> (the repo ships a `.mailmap`).

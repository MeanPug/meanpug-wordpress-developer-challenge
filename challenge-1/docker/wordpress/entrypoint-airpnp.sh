#!/usr/bin/env bash
#
# AirPnP idempotent seed entrypoint.
#
# Boot flow:
#   1. Start the upstream WordPress entrypoint in the background so Apache
#      and wp-config.php come up.
#   2. Wait for MySQL.
#   3. If a real seed SQL file is mounted and the marker is absent, import
#      the dump and flush the front-page transient. Write a marker file
#      so subsequent restarts skip the import.
#   4. Ensure the Advanced Custom Fields plugin is active (safety net — the
#      plugin is pre-installed in the wordpress image, but this catches the
#      case where the plugins volume is wiped without rebuilding).
#
# Re-seed: `docker compose down -v && rm -f wp/.airpnp-seeded && docker compose up -d`
set -euo pipefail

WP_PATH=/var/www/html
MARKER=$WP_PATH/.airpnp-seeded
SQL_FILE=$WP_PATH/airpnp-seed.sql
DB_HOST=${WORDPRESS_DB_HOST:-db:3306}
DB_USER=${WORDPRESS_DB_USER:-wordpress}
DB_PASS=${WORDPRESS_DB_PASSWORD:-wordpress}
DB_NAME=${WORDPRESS_DB_NAME:-wordpress}

log() {
    printf '[airpnp] %s\n' "$*" >&2
}

wait_for_mysql() {
    local host port
    host="${DB_HOST%%:*}"
    port="${DB_HOST##*:}"
    if [ "$port" = "$host" ]; then
        port=3306
    fi
    log "waiting for mysql at ${host}:${port}..."
    until mysql -h "$host" -P "$port" -u "$DB_USER" -p"$DB_PASS" -e ';' 2>/dev/null; do
        sleep 2
    done
    log "mysql up."
}

run_seed() {
    if [ -f "$MARKER" ]; then
        log "marker present, skipping seed."
        return 0
    fi

    if [ ! -f "$SQL_FILE" ] || [ ! -s "$SQL_FILE" ] || ! grep -q "CREATE TABLE" "$SQL_FILE"; then
        log "no real seed SQL at $SQL_FILE (placeholder only) — first-boot wizard path (run WP install in browser)."
        return 0
    fi

    if wp --path="$WP_PATH" --allow-root core is-installed 2>/dev/null; then
        log "WP already installed; skipping seed import (delete marker + drop db to re-seed)."
        touch "$MARKER"
        return 0
    fi

    log "importing seed db from $SQL_FILE..."
    mysql -h "${DB_HOST%%:*}" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < "$SQL_FILE"

    log "waiting for wp-cli to see installed WP..."
    local tries=0
    until wp --path="$WP_PATH" --allow-root core is-installed 2>/dev/null; do
        tries=$((tries + 1))
        if [ "$tries" -gt 30 ]; then
            log "wp-cli could not reach WP after 60s, aborting seed."
            return 1
        fi
        sleep 2
    done

    wp --path="$WP_PATH" --allow-root transient delete airpnp_front_cards 2>/dev/null || true

    touch "$MARKER"
    log "seed complete."
}

# Theme scaffolding calls ACF's get_field() in the wp_footer schema hook,
# so the homepage 500s without it. Install + activate idempotently on
# every boot — cheap, and survives wiped plugin volumes.
ensure_acf() {
    if wp --path="$WP_PATH" --allow-root plugin is-active advanced-custom-fields 2>/dev/null; then
        return 0
    fi
    log "installing + activating advanced-custom-fields..."
    wp --path="$WP_PATH" --allow-root plugin install advanced-custom-fields --activate 2>&1 || \
        log "ACF install failed; homepage will 500 until installed manually."
}

docker-entrypoint.sh "$@" &
APACHE_PID=$!

# Seed in a subshell so a failure doesn't kill the container; preserve the
# exit code in the log so silent failures are diagnosable.
(
    wait_for_mysql
    run_seed
    ensure_acf
) || log "seed step failed with exit code $?; container will keep running."

wait "$APACHE_PID"

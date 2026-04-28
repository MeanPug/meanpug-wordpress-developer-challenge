#!/usr/bin/env bash
#
# Provisions the WordPress site on first `docker compose up` and re-runs idempotently.
# Run via the wpcli companion service in docker-compose.yml.
#
set -euo pipefail

WP_PATH=/var/www/html
WP="wp --allow-root --path=$WP_PATH"

# Wait for the WordPress entrypoint to copy core files into the bind-mounted ./wp/
until [ -f "$WP_PATH/wp-load.php" ]; do
    echo "Waiting for WordPress core files..."
    sleep 2
done

# Wait for the database to accept connections
until $WP db check >/dev/null 2>&1; do
    echo "Waiting for database..."
    sleep 2
done

# First-run install
if ! $WP core is-installed >/dev/null 2>&1; then
    echo "Installing WordPress..."
    $WP core install \
        --url="http://localhost:8000" \
        --title="Pug & Puggle, ESQ." \
        --admin_user=admin \
        --admin_password=password \
        --admin_email=admin@example.com \
        --skip-email
fi

# Free plugins from WP.org (idempotent — install is a no-op if already present)
echo "Installing free plugins..."
$WP plugin install wordpress-seo classic-editor --activate

# Any *.zip dropped into ./plugins/ (e.g. ACF Pro) gets installed and activated
shopt -s nullglob
for zip in "$WP_PATH"/wp-content/plugins/*.zip; do
    echo "Installing zipped plugin: $(basename "$zip")"
    $WP plugin install "$zip" --activate --force
done

# Activate our custom schema plugin (CPTs + taxonomies)
$WP plugin activate pug-puggle-schema || true

# Activate this challenge's theme
$WP theme activate challenge-2-theme || true

# Flush rewrites so CPT/taxonomy permalinks resolve immediately
$WP rewrite flush --hard

echo "Provisioning complete."

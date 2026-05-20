#!/bin/sh
set -e

THEME_SLUG="challenge-2-theme"
PLUGIN_SLUG="advanced-custom-fields"

echo "[wpcli] Waiting for WordPress core to be installed..."
until wp core is-installed 2>/dev/null; do
    sleep 2
done

echo "[wpcli] Ensuring '$PLUGIN_SLUG' is installed and active..."
if ! wp plugin is-installed "$PLUGIN_SLUG" 2>/dev/null; then
    wp plugin install "$PLUGIN_SLUG"
fi
wp plugin activate "$PLUGIN_SLUG"

echo "[wpcli] Activating theme '$THEME_SLUG'..."
wp theme activate "$THEME_SLUG"

echo "[wpcli] Done."

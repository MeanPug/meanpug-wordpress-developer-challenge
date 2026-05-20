# Pinned WordPress + PHP image. `latest` would drift between machines, so we
# fix to a known-good combo for reproducible reviewer environments.
FROM wordpress:6.5-php8.2-apache

# wp-cli (for DB import + plugin queries) and mysql-client (for raw SQL
# import). `less` is wp-cli's preferred pager.
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        default-mysql-client \
        less \
        curl \
        unzip \
        ca-certificates \
    && rm -rf /var/lib/apt/lists/* \
    && curl -fsSL https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar -o /usr/local/bin/wp \
    && chmod +x /usr/local/bin/wp

# Pre-install Advanced Custom Fields into the image. The upstream theme's
# schema.php calls get_field() on every page render, so ACF must be available
# before Apache serves the first request. Baking it into the image (rather
# than relying on a runtime `wp plugin install`) avoids the race where the
# first HTTP requests after boot 500 while wp-cli is still installing.
RUN curl -fsSL https://downloads.wordpress.org/plugin/advanced-custom-fields.zip -o /tmp/acf.zip \
    && unzip -q /tmp/acf.zip -d /usr/src/wordpress/wp-content/plugins/ \
    && rm /tmp/acf.zip \
    && chown -R www-data:www-data /usr/src/wordpress/wp-content/plugins/advanced-custom-fields

COPY docker/wordpress/entrypoint-airpnp.sh /usr/local/bin/entrypoint-airpnp.sh
RUN chmod +x /usr/local/bin/entrypoint-airpnp.sh

ENTRYPOINT ["/usr/local/bin/entrypoint-airpnp.sh"]
CMD ["apache2-foreground"]

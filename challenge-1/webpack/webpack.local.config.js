/**
 * Local development webpack config used by the `watch-js` npm script
 * (see package.json) and, by extension, the `static` Docker container.
 *
 * Upstream the pipeline expects each developer to supply their own copy of
 * this file (it's normally git-ignored), which means a fresh `docker compose
 * up` has nothing to build with and the theme renders unstyled. We commit a
 * sensible default so the environment is reproducible out of the box.
 *
 * It simply re-exports the shared config. Because the dev script does not set
 * NODE_ENV=production, webpack.config.js resolves to its watch-friendly,
 * unminified `dev` branch automatically.
 */
module.exports = require( './webpack.config.js' );

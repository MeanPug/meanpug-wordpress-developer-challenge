/**
 * Front-page webpack entry.
 *
 * Bundled to `theme/front-page.js` and conditionally enqueued via
 * `Airpnp\Assets` only on `is_front_page()`. Imports the front-page CSS
 * (extracted to `theme/front-page.css` by MiniCssExtractPlugin) plus each
 * interactive component.
 */
import './front-page.css';
import './js/components/airpnp-search';
import './js/components/airpnp-user-pill';
import './js/components/airpnp-main-nav';
import './js/components/airpnp-nav-tabs';
import './js/components/airpnp-lang-pill';

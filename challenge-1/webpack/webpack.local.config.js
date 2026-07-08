const config = require('./webpack.config');

module.exports = {
    ...config,
    mode: 'development',
    devtool: 'source-map',
    watchOptions: {
        ...(config.watchOptions || {}),
        ignored: ['**/node_modules', '**/dist'],
    },
};
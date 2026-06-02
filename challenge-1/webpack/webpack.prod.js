const common = require('./webpack.common');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const TerserJSPlugin = require('terser-webpack-plugin');

module.exports = Object.assign({}, common, {
    mode: 'production',
    optimization: {
        minimize: true,
        minimizer: [new TerserJSPlugin({}), new CssMinimizerPlugin()]
    }
});

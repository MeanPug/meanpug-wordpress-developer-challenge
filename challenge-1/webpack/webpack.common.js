const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const root = path.dirname(__dirname);

module.exports = {
    entry: {
        critical: path.resolve(root, 'theme/assets/critical.js'),
        main: path.resolve(root, 'theme/assets/main.js')
    },
    output: {
        path: path.resolve(root, 'theme'),
        filename: '[name].js',
        assetModuleFilename: 'assets/images/build/[hash][ext][query]'
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '[name].css'
        })
    ],
    externals: {
        jquery: 'jQuery',
        '@meanpug-llc/wp-core': 'MeanPug'
    },
    module: {
        rules: [
            {
                test: /\.css$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader
                    },
                    'css-loader',
                    {
                        loader: 'postcss-loader',
                        options: {
                            postcssOptions: {
                                plugins: [
                                    require('postcss-import'),
                                    require('tailwindcss/nesting'),
                                    require('tailwindcss'),
                                    require('autoprefixer'),
                                    require('postcss-nested')
                                ]
                            }
                        }
                    }
                ]
            },
            {
                test: /\.m?js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            },
            {
                test: /\.(svg)$/,
                use: {
                    loader: 'url-loader'
                }
            },
            {
                test: /\.(png|jpg|jpeg|gif|webp)$/,
                type: 'asset/resource',
                generator: {
                    filename: 'assets/images/build/[hash][ext][query]'
                }
            }
        ]
    }
};

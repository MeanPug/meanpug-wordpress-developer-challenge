const path = require('path');
const { series, watch, parallel, src, dest } = require('gulp');
const cleanCSS = require('gulp-clean-css'); // Re-enabled
const gulpPostcss = require('gulp-postcss');
const nested = require('postcss-nested'); // Re-enabled
const autoprefixer = require('autoprefixer'); // Re-enabled
const tailwindcss = require('tailwindcss');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');

const themeRoot = path.resolve('theme');
const blockSources = path.resolve(themeRoot, 'blocks/');
const moduleSources = path.resolve(themeRoot, 'inc/modules/');
const outputDir = path.resolve(themeRoot, 'dist/');


function buildCss(cb) {
    const tailwindConfigPath = path.resolve(__dirname, 'tailwind.config.js');

    const plugins = [
        tailwindcss(tailwindConfigPath),
        nested, // Re-enabled
        autoprefixer // Re-enabled
    ];

    console.log('Resolved tailwind.config.js path:', tailwindConfigPath);
    console.log('PostCSS Plugins being used:', plugins);

    return src([
            path.resolve(blockSources, '**/*.css'),
            path.resolve(moduleSources, '**/*.css')
        ])
        .pipe(gulpPostcss(plugins))
        .pipe(rename(function (path) { // Re-enabled
            path.basename = path.dirname;
            path.extname = '.min.css';
        }))
        .pipe(cleanCSS({compatibility: 'ie8'})) // Re-enabled
        .pipe(dest(outputDir));
}

function buildJs(cb) {
    return src(path.resolve(blockSources, '**/*.js'))
        .pipe(src(path.resolve(moduleSources, '**/*.js')))
        .pipe(babel())
        .pipe(uglify())
        .pipe(rename({ extname: '.min.js' }))
        .pipe(dest(outputDir));
}

exports.default = parallel(buildJs, buildCss);
exports.dev = function devWatch() {
    watch(path.resolve(blockSources, '**/*.(css|js)'), parallel(buildJs, buildCss));
    watch(path.resolve(moduleSources, '**/*.(css|js)'), parallel(buildJs, buildCss));
};

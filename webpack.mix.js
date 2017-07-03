const mix = require('laravel-mix').mix;

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
.copy('node_modules/bootstrap-v4-dev/dist/css/bootstrap.min.css', 'resources/assets/css/bootstrap.min.css')
.copy('node_modules/font-awesome/css/font-awesome.min.css', 'resources/assets/css/font-awesome.min.css')
.js([
    'resources/assets/js/app.js',
    'node_modules/bootstrap-v4-dev/dist/js/bootstrap.min.js'
], 'public/js')
.sass('resources/assets/sass/app.scss', 'public/scss/app.css')
.styles([
    'resources/assets/css/bootstrap.min.css',
    'resources/assets/css/font-awesome.min.css'
], 'public/css/app.css')
.version()
.browserSync({
    proxy: 'hwi.mismaven.kr'
});
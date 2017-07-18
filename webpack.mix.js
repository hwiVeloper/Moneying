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
.copy('node_modules/font-awesome/fonts/**', 'public/fonts')
.autoload({
    jquery: ['$', 'window.jQuery', 'jQuery'],
    tether: ['window.Tether', 'Tether']
})
.js(['node_modules/tether/dist/js/tether.min.js',
     'node_modules/jquery/dist/jquery.min.js',
     'node_modules/bootstrap-v4-dev/dist/js/bootstrap.min.js'
 ], 'public/js/all.js')
.js('resources/assets/js/app.js', 'public/js/app.js')
.sass('resources/assets/sass/app.scss', 'public/scss/app.css')
.styles([
    'resources/assets/css/bootstrap.min.css',
    'resources/assets/css/font-awesome.min.css',
    'resources/assets/css/font.css',
    'resources/assets/css/navigation.css',
    'resources/assets/css/register_login.css',
    'resources/assets/css/account_calendar.css',
    'resources/assets/css/form.css'
], 'public/css/app.css')
.version()
.browserSync({
    proxy: 'hwi.mismaven.kr'
});

// if (mix.inProduction()) {
//     mix.version();
// }
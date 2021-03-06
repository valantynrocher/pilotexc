const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/parameters/accounts-general.js', 'public/js/parameters')
    .js('resources/js/parameters/accounts-analytic.js', 'public/js/parameters')
    .js('resources/js/parameters/fiscal-years.js', 'public/js/parameters')
    .js('resources/js/scriptures/scriptures.js', 'public/js/scriptures')
    .js('resources/js/reports/reports.js', 'public/js/dashboard')
    .sass('resources/sass/app.scss', 'public/css');

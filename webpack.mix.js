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
mix.styles([
    'resources/assets/admin/css/style.css',
], 'public/css/app.css');


mix.scripts([
    'resources/assets/admin/js/script.js',
], 'public/js/app.js');

mix.scripts([
    'resources/assets/client/js/script.js',
], 'public/js/client/app.js');

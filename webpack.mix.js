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

mix.styles([
    'resources/assets/client/css/custom.css',
    'resources/assets/client/css/toastr.css',
    'resources/assets/client/css/chat.css',
], 'public/css/client/app.css');


mix.scripts([
    'resources/assets/admin/js/script.js',
], 'public/js/app.js');

mix.scripts([
    'resources/assets/admin/js/chat.js',
], 'public/js/chat.js');

mix.scripts([
    'resources/assets/client/js/script.js',
    'resources/assets/client/js/toastr.min.js',
], 'public/js/client/app.js');

mix.scripts([
    'resources/assets/client/js/chat.js',
], 'public/js/client/chat.js');


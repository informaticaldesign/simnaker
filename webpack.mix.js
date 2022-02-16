const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/users.js', 'public/js')
    .js('resources/js/modules.js', 'public/js')
    .js('resources/js/roles.js', 'public/js')
    .js('resources/js/detailroles.js', 'public/js')
    .js('resources/js/home.js', 'public/js')
    .js('resources/js/topik.js', 'public/js')
    .js('resources/js/organisasi.js', 'public/js')
    .js('resources/js/dataset.js', 'public/js')
    .js('resources/js/visualisasi.js', 'public/js')
    .js('resources/js/infografis.js', 'public/js')
    .js('resources/js/markerclusterer.js', 'public/js')
    .js('resources/js/pengguna.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css')
    .postCss('resources/css/timeline.css', 'public/css')
    .postCss('resources/css/menus.css', 'public/css');

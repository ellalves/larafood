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

mix
    .js('resources/js/script.js','public/js/script.js')
    .js('resources/js/app.js','public/js/app.js')
    .js('resources/views/site/js/site.js','public/js/site.js')
    .vue()

    .css('resources/views/site/css/site.css', 'public/css/site.css')
    .sass('resources/sass/app.scss', 'public/css')
    .version();
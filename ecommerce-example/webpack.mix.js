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
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

mix.copyDirectory('resources/css/assets', 'public/css/assets');
mix.copyDirectory('resources/js/assets', 'public/js/assets');

mix.copyDirectory('resources/css/admin', 'public/css/admin');
mix.copyDirectory('resources/js/admin', 'public/js/admin');
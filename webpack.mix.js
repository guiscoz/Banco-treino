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

mix.copyDirectory('resources/js/app.js', 'public/js')
    .copyDirectory('resources/js/bootstrap.min.js', 'public/js')
    .copyDirectory('resources/js/jquery-3.6.0.min.js', 'public/js')
    .copyDirectory('resources/css/bootstrap.min.css', 'public/css')
    .copyDirectory('resources/css/fontawesome.min.css', 'public/css')
    .copyDirectory('resources/bancoLogo.png', 'public/')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ]);

if (mix.inProduction()) {
    mix.version();
}
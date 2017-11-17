let mix = require('laravel-mix');

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

mix.js('resources/assets/js/vendors/materialize/app.js', 'public/assets/vendors/materialize/js/')
   .js('resources/assets/js/vendors/bootstrap/app.js', 'public/assets/vendors/bootstrap/js')
   .sass('resources/assets/sass/vendors/bootstrap/app.scss', 'public/assets/vendors/bootstrap/css')
   .sass('resources/assets/sass/vendors/materialize/app.scss', 'public/assets/vendors/materialize/css');

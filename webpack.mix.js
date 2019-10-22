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
    'resources/assets/plantilla/css/adminlte.css',
    'resources/assets/plantilla/css/adminlte.css.map',
    'resources/assets/plantilla/css/bootstrap.min.css',
    'resources/assets/plantilla/css/bootstrap.min.css.map',
    'resources/assets/plantilla/css/bootstrap-grid.min.css',
    'resources/assets/plantilla/css/bootstrap-grid.min.css.map',
    'resources/assets/plantilla/css/bootstrap-reboot.min.css',
    'resources/assets/plantilla/css/bootstrap-reboot.min.css.map',
    'resources/assets/plantilla/css/font-awesome.css.map',
    'resources/assets/plantilla/css/font-awesome.min.css',
    'resources/assets/plantilla/css/owl.carousel.min.css',
    'resources/assets/plantilla/css/ionicons.min.css',
    'resources/assets/plantilla/css/sweetalert.css'
],  'public/css/plantilla.css')

.js(['resources/js/app.js'],'public/js/app.js');




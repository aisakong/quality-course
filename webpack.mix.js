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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .copy('node_modules/simplemde/dist/simplemde.min.js', 'public/js/simplemde.min.js')
    .copy('node_modules/simplemde/dist/simplemde.min.css', 'public/css/simplemde.min.css')
    .copyDirectory('resources/assets/vendor/InlineAttachment/js', 'public/js')
    .copy('node_modules/_font-awesome@4.7.0@font-awesome/css/font-awesome.min.css', 'public/css/font-awesome.min.css')
    .copyDirectory('node_modules/_font-awesome@4.7.0@font-awesome/fonts', 'public/fonts')
    .copy('resources/assets/vendor/scrollup/js/jquery.scrollUp.min.js', 'public/js/jquery.scrollUp.min.js')
    .copyDirectory('resources/assets/vendor/scrollup/css', 'public/css')
    .copy('node_modules/dplayer/dist/DPlayer.min.css', 'public/css/DPlayer.min.css')
    .copy('node_modules/dplayer/dist/DPlayer.min.js', 'public/js/DPlayer.min.js')
    .version();

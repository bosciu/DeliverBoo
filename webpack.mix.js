const mix = require("laravel-mix");

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

mix.js("resources/js/front.js", "public/js")
    .js("resources/js/back.js", "public/js")
    .sass("resources/sass/owner/backoffice.scss", "public/css")
    .sass("resources/sass/frontoffice.scss", "public/css");
const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

// let mix = require('laravel-mix');

// mix.js('src/app.js', 'dist').setPublicPath('dist');

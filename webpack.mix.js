const path = require('path');

let mix = require('laravel-mix');

mix.disableNotifications()
    .js('resources/js/app.js', 'js')
    .css('resources/css/app.css', 'css')
    .css('resources/css/main.css', 'css')
    .css('resources/css/product.css', 'css')
    .alias({
        '@bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
    });

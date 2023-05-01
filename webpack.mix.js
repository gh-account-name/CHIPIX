const path = require('path');

const mix = require('laravel-mix');
const { VueLoaderPlugin } = require('vue-loader');

mix.disableNotifications()
    .js('resources/js/app.js', 'js')
    .js('resources/js/admin.js', 'js')
    .vue()
    .css('resources/css/app.css', 'css')
    .css('resources/css/main.css', 'css')
    .css('resources/css/product.css', 'css')
    .alias({
        '@bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        '@vue': path.resolve(__dirname, 'node_modules/vue/dist/vue.esm-browser.js'),
    })
    .webpackConfig({
        // resolve: {
        //     alias: {
        //         'vue$': 'vue/dist/vue.runtime.esm.js',
        //     },
        // },
        module: {
            rules: [
                {
                    test: /\.vue$/,
                    loader: 'vue-loader',
                },
                {
                    test: /\.js$/,
                    loader: 'babel-loader',
                    exclude: /node_modules/,
                },
            ],
        },
        // resolve: {
        //     alias: {
        //         '@': path.resolve('resources/js'),
        //         '~': path.resolve('node_modules'),
        //         'vue$': 'vue/dist/vue.esm-bundler.js',
        //     },
        // },
        plugins: [new VueLoaderPlugin()],
    });

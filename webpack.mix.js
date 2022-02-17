const mix = require('laravel-mix');
require('dotenv').config();
const webpack = require('webpack');
require('mix-env-file');

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

mix.webpackConfig({
    plugins: [
        new webpack.ProvidePlugin({
            process: 'process/browser',
        }),
        new webpack.DefinePlugin({
            'process.env': {
                APP_CLIENT_KEY: JSON.stringify(process.env.APP_CLIENT_KEY),
            }
        })
    ]
})

mix.setPublicPath('public/assets');
mix.setResourceRoot('../');

mix.js('resources/js/admin.js', 'public/assets/js')
    .sass('resources/sass/admin.scss', 'public/assets/css')
    .sourceMaps();

mix.js('resources/assets/js/front.js', 'public/assets/js')
    .sass('resources/assets/sass/public.scss', 'public/assets/css')
    .sourceMaps();


if (mix.inProduction()) {
    mix.version();
}

const mix = require('laravel-mix');
const webpack = require('webpack');

mix
    .setPublicPath('public')
    // .js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/scss/app.scss', 'public/css')
    .sass('resources/assets/scss/site.scss', 'public/css')
    // .copy('resources/assets/img', 'public/img')
    .sourceMaps()
    .version();


// mix.webpackConfig({
//     plugins: [
//         new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
//     ],
//     resolve: {
//         alias: {
//             'vue$': 'vue/dist/vue.runtime.esm.js'
//         }
//     }
// });
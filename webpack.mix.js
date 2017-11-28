const mix = require('laravel-mix');
const webpack = require('webpack');

mix
    .setPublicPath('public')
    .sass('resources/assets/scss/app.scss', 'public/css')
    .sass('resources/assets/scss/site.scss', 'public/css')
    .js('resources/assets/js/app.js', 'public/js')
    .copy('public/js', '../../../public/vendor/ngeblog/js')
    .sourceMaps()
    .version();


// mix.options({
//     processCssUrls: false
//   }).sass('resources/assets/sass/app.scss', 'publishable/assets/css')
//   .js('resources/assets/js/app.js', 'publishable/assets/js');


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
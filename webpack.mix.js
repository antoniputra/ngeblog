const mix = require('laravel-mix');
const webpack = require('webpack');

mix
    .setPublicPath('publishable/assets')
    .sass('resources/assets/scss/app.scss', 'publishable/assets/css')
    .sass('resources/assets/scss/site.scss', 'publishable/assets/css')
    .js('resources/assets/js/app.js', 'publishable/assets/js')
    .copy('publishable/assets', '../../../public/vendor/ngeblog')
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
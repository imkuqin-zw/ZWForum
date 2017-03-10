const { mix } = require('laravel-mix');
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

const path = require('path');

mix.webpackConfig({
  resolve: {
    alias: {
      // https://github.com/vuejs/vue/wiki/Vue-2.0-RC-Starter-Resources
      // vue: 'vue/dist/vue',
      configs: path.resolve(__dirname, 'resources/assets/js/configs'),
      components: path.resolve(__dirname, 'resources/assets/js/components'),
      views: path.resolve(__dirname, 'resources/assets/js/views'),
      vendor: path.resolve(__dirname, 'resources/assets/js/vendor'),
     // sass: path.resolve(__dirname, 'resources/assets/sass'),
      'vuex-store': path.resolve(__dirname, 'resources/assets/js/store'),
    }
  }
});

mix.js('resources/assets/js/app.js', 'public/assets/js/app.js')
  .sass('resources/assets/sass/app.scss', 'public/assets/css/app.css')
  .sass('resources/assets/sass/all.scss', 'public/css/all.css')
  .sass('resources/assets/sass/markdown.scss', 'public/css/markdown.css')
  .copy('node_modules/simplemde/dist/simplemde.min.css','public/css/simplemde.min.css')
  .copy('node_modules/simplemde/dist/simplemde.min.css','public/css/simplemde.min.css')
  .copy('node_modules/simplemde/dist/simplemde.min.css','public/css/simplemde.min.css');
const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

elixir.config.sourcemaps = false;
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
  //app.scss includes app css, Boostrap and Ionicons
  mix.sass('app.scss')
    .styles('admin.css')
    .styles('img.css')
    .webpack('app.js');
});

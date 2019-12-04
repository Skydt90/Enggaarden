const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
mix.combine(['resources/js/email/handlers.js'], 'public/js/email.js');
// ckeditor   
mix.combine([
   'resources/js/general/ckeditor.js',
   'resources/js/general/ckeditor-config.js',
], 'public/js/ckeditor.js');

// members
mix.combine([
   'resources/js/members/modals.js',
   'resources/js/members/invite.js',
   'resources/js/members/edit.js',
], 'public/js/members.js');

// general
mix.combine([
   'resources/js/general/toastr.js',
   'resources/js/general/ajax.js',
], 'public/js/general.js');


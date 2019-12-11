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

// emails
mix.combine([
   'resources/js/emails/modals.js',
], 'public/js/email.js');

// general
mix.combine([
   'resources/js/general/toastr.js',
   'resources/js/general/ajax.js',
   'resources/js/general/error-handlers.js',
   'resources/js/general/pagination.js',
   'resources/js/general/view-only.js',
   'resources/js/general/search.js',
   'resources/js/general/tooltip.js',
   'resources/js/general/sortable.js',
], 'public/js/general.js');

// contributions
mix.combine([
   'resources/js/contributions/modals.js',
   'resources/js/contributions/edit.js'
], 'public/js/contributions.js');

// activities
mix.combine([
   'resources/js/activities/modals.js',
   'resources/js/activities/edit.js'
], 'public/js/activities.js');

// images
mix.copy(
   'resources/views/img/enggaarden_logo.png',
   'public/img/logo.png'
   );

mix.combine([
   'resources/js/users/delete.js'
], 'public/js/users.js');

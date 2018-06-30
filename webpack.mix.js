let mix = require('laravel-mix');

mix.js('resources/assets/js/admins/app.js', 'public/js/admins.js')
    .js('resources/assets/js/users/app.js', 'public/js/users.js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sourceMaps()
    .extract([
        'vue'
    ]);

if (mix.inProduction()) {
    mix.version();
}

mix.disableNotifications();

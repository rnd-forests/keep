var elixir = require('laravel-elixir');

elixir(function(mix) {

    mix.sass('app.scss');

    mix.styles([
        'vendor/font-awesome.css',
        'vendor/bootstrap.css',
        'vendor/datetimepicker.css',
        'vendor/metis-menu.css',
        'app.css'
    ], null, 'public/css');

    mix.version('public/css/all.css');

    mix.scripts([
        'vendor/jquery.min.js',
        'vendor/moment.min.js',
        'vendor/bootstrap.min.js',
        'vendor/datetimepicker.min.js',
        'vendor/chart.min.js',
        'vendor/select2.min.js',
        'vendor/metismenu.min.js',
        'plugins.js',
        'app.js'
    ], 'public/js', 'resources/assets/js');

});

process.env.DISABLE_NOTIFIER = true;

var elixir = require('laravel-elixir');

elixir(function(mix) {

    mix.sass('app.scss');

    mix.styles([
        'vendor/font-awesome.css',
        'vendor/bootstrap.css',
        'vendor/datetimepicker.css',
        'vendor/select2.css',
        'app.css'
    ], null, 'public/css');

    mix.scripts([
        'vendor/jquery.js',
        'vendor/moment.js',
        'vendor/bootstrap.js',
        'vendor/datetimepicker.js',
        'vendor/angular.js',
        'vendor/chart.js',
        'vendor/select2.js',
        'vendor/holder.js',
        'app.js'
    ], null, 'public/js');

    mix.version('public/css/all.css');

});

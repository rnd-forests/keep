var elixir = require('laravel-elixir');

elixir(function (mix) {
    mix.copy(
        'vendor/bower_components/bootstrap-sass-official/assets/stylesheets/bootstrap/',
        'resources/assets/sass/bootstrap/'
    );
    mix.copy(
        'vendor/bower_components/bootstrap-sass-official/assets/stylesheets/_bootstrap.scss',
        'resources/assets/sass/_bootstrap.scss'
    );
    mix.copy(
        'vendor/bower_components/jquery/dist/jquery.min.js',
        'public/js/vendor/jquery.min.js'
    );
    mix.copy(
        'vendor/bower_components/bootstrap/dist/js/bootstrap.min.js',
        'public/js/vendor/bootstrap.min.js'
    );
    mix.copy(
        'vendor/bower_components/chartjs/Chart.min.js',
        'public/js/vendor/chart.min.js'
    );
    mix.copy(
        'vendor/bower_components/moment/min/moment.min.js',
        'public/js/vendor/moment.min.js'
    );
    mix.copy(
        'vendor/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
        'public/js/vendor/datetimepicker.min.js'
    );
    mix.copy(
        'vendor/bower_components/select2/dist/js/select2.min.js',
        'public/js/vendor/select2.min.js'
    );
    mix.copy(
        'vendor/bower_components/sweetalert/dist/sweetalert.min.js',
        'public/js/vendor/sweetalert.min.js'
    );

    mix.copy(
        'vendor/bower_components/fontawesome/fonts',
        'public/fonts/font-awesome'
    );
    mix.copy(
        'vendor/bower_components/sweetalert/dist/sweetalert.css',
        'public/css/vendor/sweetalert.css'
    );
    mix.copy(
        'vendor/bower_components/select2/dist/css/select2.min.css',
        'public/css/vendor/select2.min.css'
    );
    mix.copy(
        'vendor/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
        'public/css/vendor/datetimepicker.min.css'
    );
    mix.copy(
        'vendor/bower_components/bootstrap-social/bootstrap-social.css',
        'public/css/vendor/bootstrap-social.css'
    );

    mix.sass('application.scss', 'public/css/app');

    mix.styles([
        'vendor/font-awesome.css',
        'vendor/bootstrap-social.css',
        'vendor/datetimepicker.min.css',
        'vendor/sweetalert.css',
        'vendor/select2.min.css'
    ], 'public/css/vendor.css', 'public/css');
    mix.styles([
        'app/application.css',
        'vendor.css'
    ], null, 'public/css');

    mix.scripts([
        'vendor/jquery.min.js',
        'vendor/bootstrap.min.js',
        'vendor/chart.min.js',
        'vendor/moment.min.js',
        'vendor/datetimepicker.min.js',
        'vendor/select2.min.js',
        'vendor/sweetalert.min.js'
    ], 'public/js/vendor.js', 'public/js');
    mix.scripts([
        'vendor.js',
        'app/application.js'
    ], null, 'public/js');

    mix.version([
        'public/css/all.css',
        'public/js/all.js'
    ]);
});

var elixir = require('laravel-elixir');

elixir(function(mix) {

    mix.sass('app.scss');

    mix.less('bootstrap/bootstrap.less');

    mix.styles([
        'bootstrap.css',
        'vendor/font-awesome.css',
        'vendor/datetimepicker.css',
        'vendor/summernote.css',
        'app.css'
    ], null, 'public/css');

    mix.version('public/css/all.css');

    mix.scripts([
        'vendor/jquery.min.js',
        'vendor/moment.min.js',
        'vendor/bootstrap.min.js',
        'vendor/chart.min.js',
        'vendor/datetimepicker.min.js',
        'vendor/select2.min.js',
        'vendor/summernote/summernote.min.js',
        'vendor/summernote/summernote-fontstyle.js',
        'vendor/summernote/summernote-video.js',
        'vendor/aui-min.js',
        'plugins.js',
        'main.js'
    ], 'public/js/all.js', 'resources/assets/js');

});

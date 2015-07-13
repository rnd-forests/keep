var elixir = require("laravel-elixir");

elixir(function (mix) {

    mix.sass("app.scss", "public/css/app.css");
    mix.less("bootstrap/bootstrap.less", "public/css/bootstrap.css");
    mix.styles([
        "bootstrap.css",
        "vendor/font-awesome.css",
        "vendor/datetimepicker.css",
        "vendor/summernote.css",
        "app.css"
    ], null, "public/css");

    mix.scripts([
        "vendor/jquery.min.js",
        "vendor/moment.min.js",
        "vendor/bootstrap.min.js",
        "vendor/chart.min.js",
        "vendor/datetimepicker.min.js",
        "vendor/select2.min.js",
        "vendor/summernote/summernote.min.js",
        "vendor/summernote/summernote-fontstyle.js",
        "vendor/summernote/summernote-video.js",
        "plugins.js",
        "main.js"
    ]);

    mix.version([
        "public/css/all.css",
        "public/js/all.js"
    ]);

});

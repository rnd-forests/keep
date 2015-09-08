var elixir = require("laravel-elixir");

elixir(function (mix) {
    mix.sass("application.scss", "public/css/application.css");
    mix.less("bootstrap/bootstrap.less", "public/css/bootstrap.css");

    mix.styles([
        "bootstrap.css",
        "vendor/font-awesome.css",
        "vendor/datetimepicker.css",
        "vendor/summernote.css",
        "application.css"
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
        "application.js",
        "task.js",
        "search.js",
        "plugins.js"
    ]);

    mix.version(["public/css/all.css", "public/js/all.js"]);
});

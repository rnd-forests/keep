var elixir = require("laravel-elixir");

elixir(function(mix) {
    mix.sass("application.scss", "public/css/application.css");
    mix.less("bootstrap/bootstrap.less", "public/css/bootstrap.css");

    mix.styles([
        "vendor/font-awesome.css",
        "vendor/datetimepicker.css",
        "bootstrap.css",
        "vendor/bootstrap-social.css",
        "vendor/sweet-alert.css",
        "application.css"
    ], null, "public/css");

    mix.scripts([
        "vendor/jquery.min.js",
        "vendor/moment.min.js",
        "vendor/bootstrap.min.js",
        "vendor/chart.min.js",
        "vendor/datepicker.min.js",
        "vendor/select2.min.js",
        "vendor/sweet-alert.min.js",
        "application.js"
    ]);

    mix.version([
        "public/css/all.css",
        "public/js/all.js"
    ]);
});

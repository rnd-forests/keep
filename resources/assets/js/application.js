$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("[data-toggle=tooltip]").tooltip();
    $(".alert").not(".alert-danger").not(".notification").delay(3000).slideUp();
    $(".task-wrapper").find("iframe").wrap("<div class='embed-responsive embed-responsive-16by9'></div>");

    $("#scroll-top").on("click", function() {
        $('body, html').animate({scrollTop: 0}, 800);
        return false;
    });
});

(function() {
    Chart.defaults.global.scaleFontFamily = "Source Sans Pro";
    Chart.defaults.global.tooltipFontFamily = "Source Sans Pro";
    Chart.defaults.global.scaleFontSize = 14;
    Chart.defaults.global.scaleBeginAtZero = true;
    Chart.defaults.global.animationSteps = 80;
    Chart.defaults.global.responsive = true;
})();

$(function() {
    $('.task-wrapper').find('iframe').wrap("<div class='embed-responsive embed-responsive-16by9'></div>");
    $('.timeline').find('iframe').wrap("<div class='embed-responsive embed-responsive-16by9'></div>");

    $('a[data-toggle = "tab"]').on('shown.bs.tab', function() {
        localStorage.setItem('lastTab', $(this).attr('href'));
    });

    var lastTab = localStorage.getItem('lastTab');

    if (lastTab) {
        $('a[href=' + lastTab + ']').tab('show');
    } else {
        $('a[data-toggle="tab"]:first').tab('show');
    }
});

$(function() {
    $('#scroll-top').click(function() {
        $('body, html').animate({
            scrollTop:0}, 1000
        );
        return false;
    });
});
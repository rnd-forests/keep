(function() {
    $('.task-wrapper').find('iframe').wrap("<div class='embed-responsive embed-responsive-16by9'></div>");
    $('#scroll-top').click(function() {
        $('body, html').animate({ scrollTop:0 }, 1000);
        return false;
    });
})();
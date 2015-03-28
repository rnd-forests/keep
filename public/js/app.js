$(function() {

    $('div.alert').not('.alert-danger').delay(3000).slideUp(300);
    //--------------------------------------------------------------------------------
    $('#user_update_form_datetimepicker').datetimepicker({
        format: "L"
    });

    $('.task_form_datetimepicker').datetimepicker({
        format: 'LLL'
    });
    //--------------------------------------------------------------------------------
    $('a[data-toggle = "tab"]').on('shown.bs.tab', function() {
        localStorage.setItem('lastTab', $(this).attr('href'));
    });

    var lastTab = localStorage.getItem('lastTab');

    if (lastTab) {
        $('a[href=' + lastTab + ']').tab('show');
    } else {
        $('a[data-toggle="tab"]:first').tab('show');
    }
    //--------------------------------------------------------------------------------
    $('#tag_list').select2({
        placeholder: 'Choose your tags'
    });
    //--------------------------------------------------------------------------------
    $('#scroll-top').click(function() {
        $('body, html').animate({
            scrollTop:0}, 1000
        );
        return false;
    })

    $(window).scroll(function() {
        if ($(window).scrollTop() == 0) {
            $('#scroll-top').stop(false, true).fadeOut(400);
        } else {
            $('#scroll-top').stop(false, true).fadeIn(400);
        }
    });
    //--------------------------------------------------------------------------------
    Holder.addTheme("members", {
        background: "#E74C3C",
        foreground: "#ffffff",
        size: 50,
        font: "Source Sans Pro"
    });

    Holder.addTheme("tasks", {
        background: "#9B59B6",
        foreground: "#ffffff",
        size: 50,
        font: "Source Sans Pro"
    });

    Holder.addTheme("notifications", {
        background: "#1ABC9C",
        foreground: "#ffffff",
        size: 50,
        font: "Source Sans Pro"
    });

    Holder.addTheme("visitors", {
        background: "#3A5A97",
        foreground: "#ffffff",
        size: 50,
        font: "Source Sans Pro"
    });
})(jQuery);
$(function() {
    $('div.alert').not('.alert-danger').delay(3000).slideUp(300);
    $('[data-toggle="tooltip"]').tooltip();
});

//--------------------------------------------------------------------------------

$(function() {
    $('#user_update_form_datetimepicker').datetimepicker({
        format: "L"
    });

    $('.task_form_datetimepicker').datetimepicker({
        format: 'LLL'
    });
});

//--------------------------------------------------------------------------------

$(function() {
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

//--------------------------------------------------------------------------------

$(function() {
    $('#tag_list').select2({
        placeholder: 'Choose your tags'
    });
});

//--------------------------------------------------------------------------------

$(function() {
    $('#scroll-top').click(function() {
        $('body, html').animate({
                scrollTop:0}, 1000
        );
        return false;
    });

    $(window).scroll(function() {
        if ($(window).scrollTop() == 0) {
            $('#scroll-top').stop(false, true).fadeOut(400);
        } else {
            $('#scroll-top').stop(false, true).fadeIn(400);
        }
    });
});

//--------------------------------------------------------------------------------

$(function() {
    $('#side-menu').metisMenu();
});

$(function() {
    $(window).bind("load resize", function() {
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});

//--------------------------------------------------------------------------------

$(function() {
    $('#admin-cancel-account-modal').on('show.bs.modal', function(event) {
        var form = $(event.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', form);
    })

    $('#admin-cancel-account-modal').find('.modal-footer #confirm').on('click', function() {
        $(this).data('form').submit();
    });
});

$(function() {
    $('#delete-task-modal').on('show.bs.modal', function(event) {
        var form = $(event.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', form);
    })

    $('#delete-task-modal').find('.modal-footer #confirm').on('click', function() {
        $(this).data('form').submit();
    });
});

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

$(function() {
    $('#scroll-top').click(function() {
        $('body, html').animate({
                scrollTop:0}, 1000
        );
        return false;
    });
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

$(function() {
    var modal = $('#admin-cancel-account-modal');

    modal.on('show.bs.modal', function(event) {
        var form = $(event.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', form);
    });

    modal.find('.modal-footer #confirm').on('click', function() {
        $(this).data('form').submit();
    });
});

$(function() {
    var modal = $('#delete-task-modal');

    modal.on('show.bs.modal', function(event) {
        var form = $(event.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', form);
    });

    modal.find('.modal-footer #confirm').on('click', function() {
        $(this).data('form').submit();
    });
});

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

(function() {
    $('div.alert').not('.alert-danger').not('.notification').delay(3000).slideUp(300);
    $('[data-toggle="tooltip"]').tooltip();
    $('.task-time-form').datetimepicker();
    $('#tag_list').select2({ placeholder: 'Choose tags for this task' });
    $('#priority_list').select2();
    $('#notification_types').select2();
    $('#group_new_users').select2({ placeholder: 'Search and choose users to add' });
    $('#user_list').select2({ placeholder: 'Type and search for members' });
    $('#group_list').select2({ placeholder: 'Type and search for groups' });

    $('#summernote').summernote({
        focus: true,
        fontNames: [
            'Arial', 'Arial Black', 'Comic Sans MS',
            'Courier New', 'Helvetica Neue', 'Impact', 'Lucida Grande',
            'Tahoma', 'Times New Roman', 'Verdana', 'Futura-Medium'
        ],
        toolbar: [
            ['action', ['undo', 'redo']],
            ['fontsize', ['fontsize']],
            ['style', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['layout', ['ul', 'ol']],
            ['para', ['paragraph']],
            ['height', ['height']],
            ['insert', ['picture', 'link', 'video', 'table']],
            ['misc', ['fullscreen', 'codeview']]
        ]
    });
})();

(function() {
    $('a[data-toggle = "tab"]').on('shown.bs.tab', function() {
        localStorage.setItem('lastTab', $(this).attr('href'));
    });
    var lastTab = localStorage.getItem('lastTab');
    if (lastTab) $('a[href=' + lastTab + ']').tab('show');
    else $('a[data-toggle="tab"]:first').tab('show');
})();

(function() {
    $('.task-wrapper').find('iframe').wrap("<div class='embed-responsive embed-responsive-16by9'></div>");
    $('.timeline').find('iframe').wrap("<div class='embed-responsive embed-responsive-16by9'></div>");

    $('#scroll-top').click(function() {
        $('body, html').animate({ scrollTop:0 }, 1000);
        return false;
    });
})();

(function() {
    $('form[data-remote]').on('submit', function(e) {
        var form    = $(this);
        var url     = form.prop('action');
        var method  = form.find('input[name="_method"]').val() || 'POST';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: method,
            url: url,
            data: form.serialize(),
            success: function() {
                console.log('Form submission is done using ajax.');
            },
            error: function(xhr) {
                console.log(JSON.parse(xhr.responseText));
            }
        });

        e.preventDefault();
    });
})();
//# sourceMappingURL=app.js.map
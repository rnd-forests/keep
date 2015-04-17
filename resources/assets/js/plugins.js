(function() {
    $('div.alert').not('.alert-danger').delay(3000).slideUp(300);

    $('[data-toggle="tooltip"]').tooltip();

    $('.task-time-form').datetimepicker({
        format: 'L'
    });

    $('#tag_list').select2({
        placeholder: 'Choose tags for this task'
    });

    $('#group_new_users').select2({
        placeholder: 'Search and choose users to add'
    });

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

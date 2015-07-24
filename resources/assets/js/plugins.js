(function() {
    $('div.alert').not('.alert-danger').not('.notification').delay(3000).slideUp(300);
    $('[data-toggle="tooltip"]').tooltip();
    $('.task-time-form').datetimepicker();
    $('#tag_list').select2({ placeholder: 'Choose tags for this task' });
    $('#group_new_users').select2({ placeholder: 'Search and choose users to add' });
    $('#user_list').select2({ placeholder: 'Type and search for members' });
    $('#group_list').select2({ placeholder: 'Type and search for groups' });

    Chart.defaults.global.scaleFontFamily = "Source Sans Pro";
    Chart.defaults.global.tooltipFontFamily = "Source Sans Pro";
    Chart.defaults.global.scaleFontSize = 14;
    Chart.defaults.global.scaleBeginAtZero = true;
    Chart.defaults.global.animationSteps = 80;
    Chart.defaults.global.amimationEasing = "easeInOutExpo";
    Chart.defaults.global.responsive = true;

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

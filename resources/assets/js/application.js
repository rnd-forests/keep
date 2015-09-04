jQuery(document).ready(function () {
    $('.alert').not('.alert-danger')
        .not('.notification')
        .delay(3000)
        .slideUp();

    $('[data-toggle="tooltip"]').tooltip();

    // Date picker
    $('.task-time-form').datetimepicker();

    // Select2
    var selection = $('.multiple-selection');
    selection.select2({
        placeholder: selection.data('description')
    });

    // Search box
    $('#search-form').on('input', '#keyword', function () {
        var key = $.trim($(this).val());
        if (!key || key.length == 0) {
            $(this).popover("toggle");
        } else {
            $(this).popover("hide");
        }
    }).on('submit', function () {
        var box = $('#keyword'),
            key = $.trim(box.val());
        if (!key || key.length == 0) {
            $("#search-keyword-modal").modal("show");
            box.popover("hide");
            return false;
        }
    });

    // Responsive video wrapper
    $('.task-wrapper').find('iframe').wrap("<div class='embed-responsive embed-responsive-16by9'></div>");

    // Scroll top button
    $('#scroll-top').on('click', function () {
        $('body, html').animate({scrollTop: 0}, 800);
        return false;
    });

    // Summernote
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
});

(function () {
    // Chart.js global configurations
    Chart.defaults.global.scaleFontFamily = "Source Sans Pro";
    Chart.defaults.global.tooltipFontFamily = "Source Sans Pro";
    Chart.defaults.global.scaleFontSize = 14;
    Chart.defaults.global.scaleBeginAtZero = true;
    Chart.defaults.global.animationSteps = 80;
    Chart.defaults.global.responsive = true;
})();

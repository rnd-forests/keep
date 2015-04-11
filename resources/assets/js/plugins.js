$(function() {

    $('div.alert').not('.alert-danger').delay(3000).slideUp(300);

    $('[data-toggle="tooltip"]').tooltip();

    $('#user-birthday-form').datetimepicker({
        format: "L"
    });

    $('.task-time-form').datetimepicker({
        format: 'LLL'
    });

    $('#tag_list').select2({
        placeholder: 'Choose tags for this task.'
    });

});

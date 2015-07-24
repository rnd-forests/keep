//(function() {
//    $('a[data-toggle = "tab"]').on('shown.bs.tab', function() {
//        localStorage.setItem('lastTab', $(this).attr('href'));
//    });
//    var lastTab = localStorage.getItem('lastTab');
//    if (lastTab) $('a[href=' + lastTab + ']').tab('show');
//    else $('a[data-toggle="tab"]:first').tab('show');
//})();

(function() {
    $('.task-wrapper').find('iframe').wrap("<div class='embed-responsive embed-responsive-16by9'></div>");
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
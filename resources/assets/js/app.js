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

(function() {
    var ctx = $('#dashboard-line-chart').get(0).getContext('2d');
    var chart = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 86, 27, 90]
            }
        ]
    };

    new Chart(ctx).Line(chart, {
        bezierCurve : false
    });
})();
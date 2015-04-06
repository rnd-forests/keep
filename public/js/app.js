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

$(function() {
    var ctx = $('#dashboard-line-chart').get(0).getContext("2d");
    var data = {
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
    new Chart(ctx).Line(data, {
        scaleShowGridLines : false
    });
});

$(function() {
    var ctx = $('#dashboard-bar-chart').get(0).getContext("2d");
    var data = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.5)",
                strokeColor: "rgba(151,187,205,0.8)",
                highlightFill: "rgba(151,187,205,0.75)",
                highlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 86, 27, 90]
            }
        ]
    };
    new Chart(ctx).Bar(data, {
        scaleShowGridLines : false
    });
});

$(function() {
    var ctx = $('#dashboard-radar-chart').get(0).getContext("2d");
    var data = {
        labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 90, 81, 56, 55, 40]
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 96, 27, 100]
            }
        ]
    };

    new Chart(ctx).Radar(data);
});

$(function() {
    var ctx = $('#dashboard-doughnut-chart').get(0).getContext("2d");
    var data = [
        {
            value: 300,
            color:"#F7464A",
            highlight: "#FF5A5E",
            label: "Red"
        },
        {
            value: 50,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Green"
        },
        {
            value: 100,
            color: "#FDB45C",
            highlight: "#FFC870",
            label: "Yellow"
        }
    ]
    new Chart(ctx).Doughnut(data);
});

$(function() {
    var ctx = $('#dashboard-polar-chart').get(0).getContext("2d");
    var data = [
        {
            value: 300,
            color:"#F7464A",
            highlight: "#FF5A5E",
            label: "Red"
        },
        {
            value: 50,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Green"
        },
        {
            value: 100,
            color: "#FDB45C",
            highlight: "#FFC870",
            label: "Yellow"
        },
        {
            value: 40,
            color: "#949FB1",
            highlight: "#A8B3C5",
            label: "Grey"
        },
        {
            value: 120,
            color: "#4D5360",
            highlight: "#616774",
            label: "Dark Grey"
        }
    ];
    new Chart(ctx).PolarArea(data);
});
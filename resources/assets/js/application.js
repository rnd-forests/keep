var Keep = (function($) {
    /**
     * Initialize all handlers/listeners/plugins.
     */
    var init = function() {
        _select2();
        _tooltips();
        _scrollTop();
        _searchForm();
        _setupChartJs();
        _dateTimePicker();
        _setupAjaxHeader();
        _responsiveFrame();
        _storeTabPosition();
        _dismissibleAlerts();
    };

    /**
     * Setup the AJAX.
     *
     * @private
     */
    var _setupAjaxHeader = function() {
        var $csrf = $('meta[name=csrf-token]');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $csrf.attr('content')
            }
        });
    };

    /**
     * Global configurations for ChartJS plugin.
     *
     * @private
     */
    var _setupChartJs = function() {
        Chart.defaults.global.responsive = true;
        Chart.defaults.global.scaleFontSize = 14;
        Chart.defaults.global.animationSteps = 80;
        Chart.defaults.global.scaleBeginAtZero = true;
        Chart.defaults.global.scaleFontFamily = "Source Sans Pro";
        Chart.defaults.global.tooltipFontFamily = "Source Sans Pro";
    };

    /**
     * Activate Select2 plugin.
     *
     * @private
     */
    var _select2 = function() {
        var $selector = $('.multiple-selection');

        $selector.select2({
            placeholder: $selector.data("description")
        });
    };

    /**
     * Activate Date Time Picker plugin.
     *
     * @private
     */
    var _dateTimePicker = function() {
        var $timer = $('.task-time-form');
        $timer.datetimepicker();
    };

    /**
     * Trigger scroll top button.
     *
     * @private
     */
    var _scrollTop = function() {
        var $button = $('#scroll-top');

        $button.on("click", function(e) {
            e.preventDefault();
            $('body, html').animate({scrollTop: 0}, 800);
        });
    };

    /**
     * Activate tooltips.
     *
     * @private
     */
    var _tooltips = function() {
        var $tooltips = $('[data-toggle=tooltip]');
        $tooltips.tooltip();
    };

    /**
     * Fade out alerts.
     *
     * @private
     */
    var _dismissibleAlerts = function() {
        var $alerts = $('.alert').not('.alert-danger').not('.notification');
        $alerts.delay(2500).fadeOut();
    };

    /**
     * Make embedded video responsive.
     *
     * @private
     */
    var _responsiveFrame = function() {
        var $taskIframe = $('.task-wrapper').find('iframe');
        $taskIframe.wrap("<div class='embed-responsive embed-responsive-16by9'></div>");
    };

    /**
     * Search form.
     *
     * @private
     */
    var _searchForm = function() {
        $('#search-form').on('input', '#keyword', function() {
            var $keyword = $.trim($(this).val());
            if (!$keyword || $keyword.length == 0) {
                $(this).popover('toggle');
            } else {
                $(this).popover('hide');
            }
        }).on('submit', function() {
            var $box = $('#keyword'),
                $keyword = $.trim($box.val());
            if (!$keyword || $keyword.length == 0) {
                $('#search-keyword-modal').modal('show');
                $box.popover('hide');
                return false;
            }
        });
    };

    /**
     * Store current position of tab in Bootstrap.
     *
     * @private
     */
    var _storeTabPosition = function() {
        $('a[data-toggle=tab]').on('shown.bs.tab', function() {
            localStorage.setItem('lastTab', $(this).attr('href'));
        });
        var $last = localStorage.getItem('lastTab');
        if ($last) {
            $('[href=' + $last + ']').tab('show');
        }
    };

    /**
     * User dashboard chart.
     *
     * @param c completed tasks
     * @param f failed tasks
     * @param d due tasks
     * @param t total tasks
     */
    function dashboardChart(c, f, d, t) {
        var $context = $('#user-dashboard-stats').get(0).getContext('2d');
        var $chart = {
            labels: ["Completed", "Failed", "Processing"],
            datasets: [{
                data: [
                    Math.round(c / t * 100),
                    Math.round(f / t * 100),
                    Math.round(d / t * 100)
                ],
                fillColor: "rgba(26,179,148,0.5)",
                strokeColor: "rgba(26,179,148,0.8)",
                highlightFill: "rgba(26,179,148,0.75)",
                highlightStroke: "rgba(26,179,148,1)"
            }]
        };
        new Chart($context).Bar($chart, {
            scaleShowGridLines: false,
            barValueSpacing: 30,
            barShowStroke: true,
            barStrokeWidth: 2
        });
    }

    return {
        init: init,
        charts: {
            showUserDashboardChart: dashboardChart
        }
    };
})(jQuery);


var KeepTask = (function($) {
    /**
     * Initialize all handlers/listeners/plugins.
     */
    var init = function() {
        _deleteForm();
        _completeForm();
        _toggleContent();
    };

    /**
     * Task delete form.
     *
     * @private
     */
    var _deleteForm = function() {
        var $form = $('#task-delete-form');

        $form.on('click', 'a', function(e) {
            e.preventDefault();
            $(this).closest('form').submit();
        });
    };

    /**
     * Task complete form.
     *
     * @private
     */
    var _completeForm = function() {
        var $form = $('#task-complete-form'),
            $checkbox = $('#completed'),
            $_promise = function($_form) {
                var $promise = $.Deferred();
                $.ajax({
                    data: $_form.serialize(),
                    url: $_form.prop('action'),
                    type: $_form.find('input[name=_method]').val() || 'POST',
                    beforeSend: function() {
                        $_form.find('.loading').removeClass('hidden');
                    },
                    success: function() {
                        $promise.resolve($checkbox.is(':checked'))
                    }
                });

                return $promise;
            };

        $form.on('change', $checkbox, function(e) {
            e.preventDefault();
            var $_form = $(this).closest('form'),
                $promise = $_promise($_form);
            $promise.done(function(res) {
                var $message = $(".task-complete-message");
                if (res) {
                    $message.html("You marked this task as <strong class='text-success'>completed</strong>");
                } else {
                    $message.html("You marked this task as <strong class='text-warning'>uncompleted</strong>");
                }
            }).always(function() {
                $_form.find('.loading').addClass('hidden');
            });
        });
    };

    /**
     * Toggle task content button.
     *
     * @private
     */
    var _toggleContent = function() {
        var $button = $(".task-content-toggle");
        $button.on("click", function() {
            $(this).toggleClass("fa-arrow-circle-up fa-arrow-circle-down");
        });
    };

    return {
        init: init
    };
})(jQuery);

$(function() {
    Keep.init();
    KeepTask.init();
});
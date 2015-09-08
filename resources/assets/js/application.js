var Keep = (function() {
    /**
     * Global configurations.
     *
     * @type {{
     * el: {
     *     top: (*|jQuery|HTMLElement),
     *     note: (*|jQuery|HTMLElement),
     *     taskTimer: (*|jQuery|HTMLElement),
     *     csrf: (*|jQuery|HTMLElement),
     *     selector: (*|jQuery|HTMLElement),
     *     tooltips: (*|jQuery|HTMLElement),
     *     taskIframe: (*|jQuery),
     *     dismissibleAlerts: (*|jQuery)
     * },
     * init: Function,
     * initAJAX: Function,
     * initChartJS: Function,
     * initSummernote: Function,
     * activateSelect2: Function,
     * activateDateTimePicker: Function,
     * activateScrollButton: Function,
     * activateTooltips: Function, 
     * dismissAlerts: Function,
     * wrapIframe: Function
     * }}
     * @private
     */
    var _global = {
        "el": {
            "top": $("#scroll-top"),
            "note": $("#summernote"),
            "taskTimer": $(".task-time-form"),
            "csrf": $("meta[name=csrf-token]"),
            "selector": $(".multiple-selection"),
            "tooltips": $("[data-toggle=tooltip]"),
            "taskIframe": $(".task-wrapper").find("iframe"),
            "dismissibleAlerts": $(".alert").not(".alert-danger").not(".notification")
        },
        "init": function() {
            this.initAJAX();
            this.initChartJS();
            this.initSummernote();
            this.activateSelect2();
            this.activateDateTimePicker();
            this.activateScrollButton();
            this.activateTooltips();
            this.dismissAlerts();
            this.wrapIframe();
        },
        "initAJAX": function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': this.el.csrf.attr('content')
                }
            });
        },
        "initChartJS": function() {
            Chart.defaults.global.responsive = true;
            Chart.defaults.global.scaleFontSize = 14;
            Chart.defaults.global.animationSteps = 80;
            Chart.defaults.global.scaleBeginAtZero = true;
        },
        "initSummernote": function() {
            this.el.note.summernote({
                focus: true,
                toolbar: [
                    ['action', ['undo', 'redo', 'fullscreen', 'codeview']],
                    ['fontsize', ['fontsize']],
                    ['style', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['layout', ['ul', 'ol']],
                    ['para', ['paragraph']],
                    ['height', ['height']],
                    ['insert', ['picture', 'link', 'video', 'table']]
                ]
            });
        },
        "activateSelect2": function() {
            this.el.selector.select2({
                placeholder: this.el.selector.data("description")
            });
        },
        "activateDateTimePicker": function() {
            this.el.taskTimer.datetimepicker();
        },
        "activateScrollButton": function() {
            this.el.top.on("click", function(event) {
                event.preventDefault();
                $('body, html').animate({scrollTop: 0}, 800);
            });
        },
        "activateTooltips": function() {
            this.el.tooltips.tooltip();
        },
        "dismissAlerts": function() {
            this.el.dismissibleAlerts.delay(2500).fadeOut();
        },
        "wrapIframe": function() {
            this.el.taskIframe.wrap("<div class='embed-responsive embed-responsive-16by9'></div>");
        }
    };

    /**
     * Chart configurations.
     *
     * @type {{
     * userDashboard: Function
     * }}
     * @private
     */
    var _charts = {
        "userDashboard": function(c, f, d, t) {
            var ctx = $("#user-dashboard-stats").get(0).getContext("2d");
            var chart = {
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
            new Chart(ctx).Bar(chart, {
                scaleShowGridLines: true,
                barValueSpacing: 60,
                barShowStroke: true,
                barStrokeWidth: 2
            });
        }
    };

    /**
     * Search functionality.
     *
     * @type {{
     * init: Function
     * }}
     * @private
     */
    var _search = {
        "init": function() {
            $("#search-form").on("input", "#keyword", function() {
                var key = $.trim($(this).val());
                if (!key || key.length == 0) {
                    $(this).popover("toggle");
                } else {
                    $(this).popover("hide");
                }
            }).on("submit", function() {
                var box = $("#keyword"),
                    key = $.trim(box.val());
                if (!key || key.length == 0) {
                    $("#search-keyword-modal").modal("show");
                    box.popover("hide");
                    return false;
                }
            });
        }
    };

    /**
     * Tasks.
     *
     * @type {{
     * init: Function,
     * deleteForm: Function,
     * completeForm: Function
     * }}
     * @private
     */
    var _task = {
        "el": {
            "cForm": $("#task-complete-form"),
            "dForm": $("#task-delete-form")
        },
        init: function() {
            this.deleteForm();
            this.completeForm();
        },
        "deleteForm": function() {
            this.el.dForm.on("click", "a", function(event) {
                event.preventDefault();
                $(this).closest("form").submit();
            });
        },
        "completeForm": function() {
            var Completion = {
                complete: function(form) {
                    var promise = $.Deferred();
                    var action = form.prop("action");
                    var method = form.find("input[name=_method]").val() || "POST";
                    $.ajax({
                        type: method,
                        url: action,
                        data: form.serialize(),
                        success: function() {
                            promise.resolve(form.find("#completed").is(":checked"))
                        },
                        error: function() {
                            var error = "Something went wrong with the AJAX request.";
                            promise.reject(error);
                        }
                    });

                    return promise;
                }
            };

            this.el.cForm.on("change", $("#completed"), function(event) {
                event.preventDefault();
                var form = $(this).closest('form');
                var promise = Completion.complete(form);
                promise.done(function(response) {
                    var popup = $("#task-complete-modal");
                    var message = popup.find(".modal-title");
                    if (response) {
                        message.html("You marked this task as <strong class='text-success'>completed</strong>");
                    } else {
                        message.html("You marked this task as <strong class='text-warning'>uncompleted</strong>");
                    }
                    popup.modal("show");
                }).fail(function(message) {
                    console.log(message);
                });
            });
        }
    };

    return {
        "init": function() {
            _global.init();
            _search.init();
            _task.init();
        },
        "charts": {
            "showUserDashboardChart": _charts.userDashboard
        }
    };
})();

$(function() {
    Keep.init();
});
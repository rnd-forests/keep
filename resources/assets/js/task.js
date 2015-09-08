var task = {
    init: function() {
        $("#delete-task-form").on("click", "a", function() {
            $(this).closest("form").submit();
        });

        var TaskCompletion = {
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
                    error: function(request, errorType, errorMessage) {
                        promise.reject(errorMessage);
                    }
                });

                return promise;
            }
        };

        $("#task-complete-form").on("change", $("#completed"), function(event) {
            event.preventDefault();
            var form = $(this).closest('form');
            var promise = TaskCompletion.complete(form);
            promise.done(function(response) {
                var popup = $("#task-complete-modal");
                var message = popup.find(".modal-title");
                if (response) {
                    message.html("You marked this task as <strong>completed</strong>");
                } else {
                    message.html("You marked this task as <strong>uncompleted</strong>");
                }
                popup.modal("show");
            }).fail(function(message) {
                console.log(message)
            });
        });
    }
};

$(document).ready(function() {
    task.init();
});
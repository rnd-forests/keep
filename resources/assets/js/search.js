$(document).ready(function() {
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
});
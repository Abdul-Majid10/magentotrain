define([
    "jquery"
], function ($) {
    "use strict";

    function main(config) {
        var AjaxUrl = config.AjaxUrl;
        var status = config.status;

        $(document).ready(function () {
            reloadComments();
            $("#reloadBtn").click(function () {
                $('#loading').show();
                reloadComments();
            })
        });

        function reloadComments() {
            $.ajax({
                context: '#ajaxresponse',
                url: AjaxUrl,
                type: "POST",
                data: {status: status},
            }).done(function (data) {
                $('#loading').hide();
                $('#ajaxresponse').html(data.output);
                return true;
            });
        }
    }
    return main;
});

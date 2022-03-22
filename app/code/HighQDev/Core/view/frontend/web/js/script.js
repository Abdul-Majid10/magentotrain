require([
    'jquery'
], function ($) {

    $(document).ready(function () {
        let logoLink = $("a.logo");
        logoLink.attr("href", null);
        if (!logoLink.hasClass("cur-pointer")) {
            logoLink.addClass("cur-pointer");
        }
        $(".logo").click(function () {
            let body = $('body');
            if (body.hasClass("bkc-yellow")) {
                body.removeClass("bkc-yellow");
                body.addClass("bkc-green");
            } else if (body.hasClass("bkc-green")) {
                body.removeClass("bkc-green");
                body.addClass("bkc-yellow");
            } else {
                body.addClass("bkc-yellow");
            }
        });
    });

});

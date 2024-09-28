(function ($) {
    "use strict";
    $(function () {
        var sidebar = $(".sidebar");
        var currentPath = location.pathname.split("/").slice(1, 3).join("/");

        function addActiveClass(element) {
            var href = element.attr("href");
            // Extract relevant path from href (e.g., 'dashboard-admin/tenaga-kependidikan')
            var hrefPath = href.replace(window.location.origin + "/", "");

            // Check if currentPath is contained within the hrefPath
            if (hrefPath === currentPath) {
                element.parents(".nav-item").last().addClass("active");
                if (element.parents(".sub-menu").length) {
                    element.closest(".collapse").addClass("show");
                    element.addClass("active");
                }
                if (element.parents(".submenu-item").length) {
                    element.addClass("active");
                }
            }
        }

        $(".nav li a", sidebar).each(function () {
            var $this = $(this);
            addActiveClass($this);
        });

        // Close other submenus in sidebar on opening any
        sidebar.on("show.bs.collapse", ".collapse", function () {
            sidebar.find(".collapse.show").collapse("hide");
        });

        // Minimize sidebar toggle
        $('[data-bs-toggle="minimize"]').on("click", function () {
            var body = $("body");
            if (
                body.hasClass("sidebar-toggle-display") ||
                body.hasClass("sidebar-absolute")
            ) {
                body.toggleClass("sidebar-hidden");
            } else {
                body.toggleClass("sidebar-icon-only");
            }
        });

        // Append input helper
        $(".form-check label,.form-radio label").append(
            '<i class="input-helper"></i>'
        );

        // Horizontal menu in mobile
        $('[data-toggle="horizontal-menu-toggle"]').on("click", function () {
            $(".horizontal-menu .bottom-navbar").toggleClass("header-toggled");
        });

        // Horizontal menu navigation in mobile menu on click
        var navItemClicked = $(".horizontal-menu .page-navigation >.nav-item");
        navItemClicked.on("click", function (event) {
            if (window.matchMedia("(max-width: 991px)").matches) {
                if (!$(this).hasClass("show-submenu")) {
                    navItemClicked.removeClass("show-submenu");
                }
                $(this).toggleClass("show-submenu");
            }
        });

        $(window).scroll(function () {
            if (window.matchMedia("(min-width: 992px)").matches) {
                var header = $(".horizontal-menu");
                if ($(window).scrollTop() >= 70) {
                    $(header).addClass("fixed-on-scroll");
                } else {
                    $(header).removeClass("fixed-on-scroll");
                }
            }
        });

        if ($("#datepicker-popup").length) {
            $("#datepicker-popup").datepicker({
                enableOnReadonly: true,
                todayHighlight: true,
            });
            $("#datepicker-popup").datepicker("setDate", "0");
        }
    });

    //check all boxes in order status
    $("#check-all").click(function () {
        $(".form-check-input").prop("checked", $(this).prop("checked"));
    });

    // focus input when clicking on search icon
    $("#navbar-search-icon").click(function () {
        $("#navbar-search-input").focus();
    });

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();

        //>=, not <=
        if (scroll >= 97) {
            //clearHeader, not clearheader - caps H
            $(".fixed-top").addClass("headerLight");
        } else {
            $(".fixed-top").removeClass("headerLight");
        }
    }); //missing );
})(jQuery);

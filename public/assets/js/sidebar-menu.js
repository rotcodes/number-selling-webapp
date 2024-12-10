(function ($) {
    $(".toggle-nav").click(function () {
        $("#sidebar-links .nav-menu").css("left", "0px");
    });
    $(".mobile-back").click(function () {
        $("#sidebar-links .nav-menu").css("left", "-410px");
    });
    $(".page-wrapper").attr(
        "class",
        "page-wrapper " + localStorage.getItem("page-wrapper-dunzo")
    );
    if (localStorage.getItem("page-wrapper-dunzo") === null) {
        $(".page-wrapper").addClass("compact-wrapper");
    }

    // left sidebar and vertical menu
    if ($("#pageWrapper").hasClass("compact-wrapper")) {
        jQuery(".sidebar-title").click(function () {
            // Remove active class from all titles
            jQuery(".sidebar-title").removeClass("active");
            jQuery(".sidebar-submenu, .menu-content").slideUp("normal");

            // Check if the next submenu is hidden
            if (jQuery(this).next().is(":hidden") == true) {
                jQuery(this).addClass("active"); // Add active class to clicked title
                jQuery(this).next().slideDown("normal"); // Show the submenu
            } else {
                jQuery(this).next().slideUp("normal"); // Hide the submenu
            }
        });

        jQuery(".sidebar-submenu, .menu-content").hide(); // Initially hide submenus

        jQuery(".submenu-title").click(function () {
            jQuery(".submenu-title").removeClass("active");

            // Check if the next submenu is hidden
            if (jQuery(this).next().is(":hidden") == true) {
                jQuery(this).addClass("active"); // Add active class to clicked submenu
                jQuery(this).next().slideDown("normal"); // Show the submenu
            } else {
                jQuery(this).next().slideUp("normal"); // Hide the submenu
            }
        });
    } else if ($("#pageWrapper").hasClass("horizontal-wrapper")) {
        var smallSize = false,
            bigSize = false;

        const horizontalMenu = () => {
            var contentwidth = jQuery(window).width();
            if (contentwidth <= 992 && !smallSize) {
                (smallSize = true), (bigSize = false);
                $("#pageWrapper")
                    .removeClass("horizontal-wrapper")
                    .addClass("compact-wrapper");
                $(".page-body-wrapper")
                    .removeClass("horizontal-menu")
                    .addClass("sidebar-icon");

                jQuery(".submenu-title").click(function () {
                    jQuery(".submenu-title").removeClass("active");
                    jQuery(".submenu-title").find("div").replaceWith(
                        '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                    );

                    jQuery(".submenu-content").slideUp("normal");

                    if (jQuery(this).next().is(":hidden") == true) {
                        jQuery(this).addClass("active");
                        jQuery(this).find("div").replaceWith(
                            '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
                        );
                        jQuery(this).next().slideDown("normal");
                    } else {
                        jQuery(this).find("div").replaceWith(
                            '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                        );
                    }
                });

                jQuery(".sidebar-title").click(function () {
                    jQuery(".sidebar-title").removeClass("active");
                    jQuery(".sidebar-title").find("div").replaceWith(
                        '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                    );

                    jQuery(".sidebar-submenu, .menu-content").slideUp("normal");
                    if (jQuery(this).next().is(":hidden") == true) {
                        jQuery(this).addClass("active");
                        jQuery(this).find("div").replaceWith(
                            '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
                        );
                        jQuery(this).next().slideDown("normal");
                    } else {
                        jQuery(this).find("div").replaceWith(
                            '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                        );
                    }
                });

                jQuery(".sidebar-submenu, .menu-content").hide(); // Initially hide submenus
            }
            if (contentwidth > 992 && !bigSize) {
                (smallSize = false), (bigSize = true);
                $("#pageWrapper")
                    .removeClass("compact-wrapper")
                    .addClass("horizontal-wrapper");
                jQuery(".sidebar-title .according-menu").remove();
            }
        };

        horizontalMenu();
        addEventListener("resize", (event) => {
            horizontalMenu();
        });
    } else if ($("#pageWrapper").hasClass("compact-sidebar")) {
        var contentwidth = jQuery(window).width();
        if (contentwidth > 992) {
            $('<div class="bg-overlay1"></div>').appendTo($("body"));
        }

        jQuery(".sidebar-title").click(function () {
            jQuery(".sidebar-title").removeClass("active");
            $(".bg-overlay1").removeClass("active");
            jQuery(".sidebar-submenu").removeClass("close-submenu").slideUp("normal");
            jQuery(".sidebar-submenu, .menu-content").slideUp("normal");
            jQuery(".menu-content").slideUp("normal");

            if (jQuery(this).next().is(":hidden") == true) {
                jQuery(this).addClass("active");
                jQuery(this).next().slideDown("normal");
                $(".bg-overlay1").addClass("active");

                $(".bg-overlay1").on("click", function () {
                    jQuery(".sidebar-submenu, .menu-content").slideUp("normal");
                    $(this).removeClass("active");
                });
            }
            if (contentwidth < "992") {
                $(".bg-overlay").addClass("active");
            }
        });
        jQuery(".sidebar-submenu, .menu-content").hide();
        jQuery(".submenu-title").append(
            '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
        );
        jQuery(".submenu-title").click(function () {
            jQuery(".submenu-title")
                .removeClass("active")
                .find("div")
                .replaceWith(
                    '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                );
            jQuery(".submenu-content").slideUp("normal");
            if (jQuery(this).next().is(":hidden") == true) {
                jQuery(this).addClass("active");
                jQuery(this)
                    .find("div")
                    .replaceWith(
                        '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
                    );
                jQuery(this).next().slideDown("normal");
            } else {
                jQuery(this)
                    .find("div")
                    .replaceWith(
                        '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
                    );
            }
        });
        jQuery(".submenu-content").hide();
    }

    // toggle sidebar
    $nav = $(".sidebar-wrapper");
    $header = $(".page-header");
    $toggle_nav_top = $(".toggle-sidebar");
    $toggle_nav_top.click(function () {
        $nav.toggleClass("close_icon");
        $header.toggleClass("close_icon");
        $(window).trigger("overlay");
    });

    $(window).on("overlay", function () {
        $bgOverlay = $(".bg-overlay");
        $isHidden = $nav.hasClass("close_icon");
        if ($(window).width() <= 1184 && !$isHidden && $bgOverlay.length === 0) {
            $('<div class="bg-overlay active"></div>').appendTo($("body"));
        }

        if ($isHidden && $bgOverlay.length > 0) {
            $bgOverlay.remove();
        }
    });

    $(".sidebar-wrapper .back-btn").on("click", function (e) {
        $(".page-header").toggleClass("close_icon");
        $(".sidebar-wrapper").toggleClass("close_icon");
        $(window).trigger("overlay");
    });

    $("body").on("click", ".bg-overlay", function () {
        $header.addClass("close_icon");
        $nav.addClass("close_icon");
        $(this).remove();
    });

    $body_part_side = $(".body-part");
    $body_part_side.click(function () {
        $toggle_nav_top.attr("checked", false);
        $nav.addClass("close_icon");
        $header.addClass("close_icon");
    });

    // responsive sidebar
    var $window = $(window);
    var widthwindow = $window.width();
    (function ($) {
        "use strict";
        if (widthwindow <= 1184) {
            $toggle_nav_top.attr("checked", false);
            $nav.addClass("close_icon");
            $header.addClass("close_icon");
        }
    })(jQuery);
    $(window).resize(function () {
        var widthwindaw = $window.width();
        if (widthwindaw <= 1184) {
            $toggle_nav_top.attr("checked", false);
            $nav.addClass("close_icon");
            $header.addClass("close_icon");
        } else {
            $toggle_nav_top.attr("checked", true);
            $nav.removeClass("close_icon");
            $header.removeClass("close_icon");
        }
    });
})(jQuery);

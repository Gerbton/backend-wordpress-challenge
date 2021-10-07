class BootstrapController {
    static handleSidebarDropdown() {
        const $ = jQuery;
        let dropdown = $(".sidebar-dropdown");
        let dropdownLink = $(".sidebar-dropdown > a");
        let pageWrapper = $(".page-wrapper");

        dropdownLink.click(function () {
            $(".sidebar-submenu").slideUp(200);

            if ($(this).parent().hasClass("active")) {
                dropdown.removeClass("active");
                $(this).parent().removeClass("active");

                return;
            }

            dropdown.removeClass("active");

            $(this).next(".sidebar-submenu").slideDown(200);
            $(this).parent().addClass("active");
        });

        $("#close-sidebar").click(function () {
            pageWrapper.removeClass("toggled");
        });

        $("#show-sidebar").click(function () {
            pageWrapper.addClass("toggled");
        });
    }
}

BootstrapController.handleSidebarDropdown();

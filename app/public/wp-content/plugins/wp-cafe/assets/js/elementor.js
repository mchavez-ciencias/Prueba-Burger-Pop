(function ($, elementor) {
    "use strict";

    var wpc = {

        init: function () {
            var widgets = {
                'wpc-menu-tab.default': wpc.wpc_menu_tab,
            };
            
            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });
        },

    };
    $(window).on('elementor/frontend/init', wpc.init);
}(jQuery, window.elementorFrontend));
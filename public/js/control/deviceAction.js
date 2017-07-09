/**
 * Created by tkagnus on 19/03/2017.
 */

// jQuery Plugin Boilerplate

(function ($) {
//    http://bootstrap-notify.remabledesigns.com/
    // here we go!
    $.deviceAction = function (element, options) {
        var defaults = {};
        var plugin = this;
        plugin.settings = {};

        var $element = $(element), // reference to the jQuery version of DOM element
            element = element;    // reference to the actual DOM element
        plugin.init = function () {
            plugin.settings = $.extend({}, defaults, options);

            plugin.device = $element.data('device');

            $element.on('change', function () {

                if ($element.attr('type') == 'checkbox') {
                    plugin.target = $element.is(":checked") ? 1 : 0;
                } else {
                    plugin.target = $element.val();
                }

                return updateState();
            });

        };
        var updateState = function () {
            $.ajax({
                url: window.control.baseUrl + '/unice/device/update-state',
                type:'POST',
                data: {
                    device: plugin.device,
                    target: plugin.target
                },
                success: function (response) {
                    showNotifications(response.messages)
                }
            });
        };

        plugin.init();

    };

    // add the plugin to the jQuery.fn object
    $.fn.deviceAction = function (options) {
        return this.each(function () {
            // if plugin has not already been attached to the element
            if (undefined == $(this).data('deviceAction')) {
                var plugin = new $.deviceAction(this, options);
                $(this).data('deviceAction', plugin);
            }
        });
    }

})(jQuery);
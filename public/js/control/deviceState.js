/**
 * Created by tkagnus on 19/03/2017.
 */

// jQuery Plugin Boilerplate

(function ($) {
    $.deviceState = function (element, options) {
        var defaults = {};
        var plugin = this;
        plugin.settings = {};

        var $element = $(element), // reference to the jQuery version of DOM element
            element = element;    // reference to the actual DOM element
        plugin.init = function () {
            plugin.settings = $.extend({}, defaults, options);
            $element.addClass('deviceState');

            plugin.device = $element.data('device');
            plugin.type = $element.data('deviceType');

            hookAction();

        };

        plugin.updateState = function () {

            if (currentTarget() == false) {
                return;
            }

            $.ajax({
                url: window.control.baseUrl + '/unice/device/update-state',
                type: 'POST',
                data: {
                    device: plugin.device,
                    target: plugin.target
                },
                success: function (response) {
                    showNotifications(response.messages)
                }
            });
        };

        var hookAction = function () {

            switch (plugin.type) {
                case 'percentage':

                    plugin.sparkline($element.parent().find('[device-state-history="' + plugin.device + '"]'));

                    var timeout;
                    $element.knob({
                        min: 0,
                        max: 100,
                        angleOffset: "-90",
                        angleArc: 180,
                        fgColor: '#1ab394',
                        displayPrevious: true,
                        thickness: .4,
                        width: "100%",
                        // height: 50,
                        format: function (value) {
                            return value + '%';
                        },
                        release: function () {
                            clearInterval(timeout);
                            timeout = setTimeout(function () {
                                plugin.updateState();
                            }, 250);
                        }
                    });


                    break;

                case 'double':
                case 'triple':
                case 'quadruple':

                    var $buttons = $element.parent().find('[data-device-button="' + plugin.device + '"]');

                    $buttons.click(function () {
                        $buttons.removeClass('btn-primary')
                            .removeClass('btn-default')
                            .addClass('btn-default');

                        var $this = $(this);
                        $this.removeClass('btn-default').addClass('btn-primary');
                        $element.val($this.data('state'));

                        plugin.updateState();

                    });

                    plugin.sparkline($element.parent().find('[device-state-history="' + plugin.device + '"]'));


                    break;
                case 'impulse':
                    break;

                case 'sensor':

                    plugin.sparkline();

                    break;

            }
        };

        plugin.sparkline = function ($spark) {

            if (typeof $spark == 'undefined') {
                $element.sparkline('html', {
                    type: 'line',
                    width: '100%',
                    height: '60',
                    lineColor: '#1ab394',
                    fillColor: "#ffffff"
                });

            } else {
                $spark.sparkline('html', {
                    type: 'line',
                    width: '100%',
                    height: '60',
                    lineColor: '#1ab394',
                    fillColor: "#ffffff"
                });
            }

        };

        var currentTarget = function () {

            var oldTarget = plugin.target;
            var newTarget = $element.val().replace(/\D/g, '');
            if (oldTarget == newTarget) {
                return false;
            }

            plugin.target = newTarget;
        };

        plugin.init();

    };

    $.fn.deviceState = function (options) {
        return this.each(function () {
            var $this = $(this);
            if (undefined == $this.data('deviceState')) {
                var plugin = new $.deviceState(this, options);
                $this.data('deviceState', plugin);
            }

        });
    };

})(jQuery);
$(document).ready(function () {

    $('[data-toggle="actions-popover"]').popover({
        html: true,
        container: 'body',
        content: function () {
            return $('#actions-device-' + $(this).data('device')).html();
        }
    });

    var switches = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    switches.forEach(function (html) {
        new Switchery(html, {color: '#1AB394'});
    });


    $('[data-device]').deviceState();
});


function showNotifications(message, type) {

    switch (typeof message) {
        case 'string':
            showNotification(message, type);
            break;
        case 'object':
            for (var key in message) {
                if (typeof message[key] !== "undefined") {
                    showNotifications(message[key]);
                }
            }

            break;
    }
}


function showNotification(text, type, url) {

    if (typeof type === "undefined") {
        type = 'success';
    }
    switch (type) {
        case 'success':
            toastr.success(text);
            break;
        case 'error':
            toastr.error(text);
            break;
        case 'info':
            toastr.info(text);
            break;
        case 'warning':
            toastr.warning(text);
            break;


    }

}

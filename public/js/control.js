$(document).ready(function () {
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

                    if (typeof type == "undefined") {
                        type = key;
                    }

                    showNotifications(message[key], type);
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
        case 'error':
            toastr.error(text);
            break;
        case 'info':
            toastr.info(text);
            break;
        case 'warning':
            toastr.warning(text);
            break;
        case 'success':
        default:
            toastr.success(text);
            break;


    }

}

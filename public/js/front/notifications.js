document.addEventListener("DOMContentLoaded", function () {
    if (!Notification) {
        alert("las notificaciones no se soportan en tu navegador, descarga una nueva version")
    }
    if (Notification.permission !== "granted") {
        Notification.requestPermission();
    }
});

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;
var user = [<? php echo $user ?>];
var pusher = new Pusher('887ca7dad5d99dcb86a5', {
    cluster: 'us2',
    forceTLS: true
});

var channel = pusher.subscribe('lead-channel');
channel.bind('lead-event', function (data) {

    if (user[0] === data.message.lead_area_id) {
        if (Notification.permission !== "granted") {
            Notification.requestPermission();
        } else {
            let notificacion = new Notification("Notificación de Leads", {
                icon: "https://www.serviciosoportunidades.com/images/bolitas.png",
                body: data.message.name + ' ha sido asignado a tu área'
            })

            notificacion.onclick = function () {
                window.open("https://www.serviciosoportunidades.com/Administrator/dashboard")
            }
        }
    }

});
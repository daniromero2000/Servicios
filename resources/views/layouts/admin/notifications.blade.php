<script>
    document.addEventListener("DOMContentLoaded", function () {
          if (!Notification) {
              alert("las notificaciones no se soportan en tu navegador, descarga una nueva version")
          }
          if (Notification.permission !== "granted") {
              Notification.requestPermission();
          }
      });

        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;
        var pusher = new Pusher('8dbb3ac2e799f1f3aa32', {
            cluster: 'us2',
            forceTLS: true
        });

        var channel = pusher.subscribe('lead-channel');
        channel.bind('lead-event', function (data) {
            if (data.message) {
                var user = <?php echo $user?>;

                if (data.message.assessor_id && user.id === data.message.assessor_id) {
                              
                    if (Notification.permission !== "granted") {
                        Notification.requestPermission();
                    } else {
                        notificacion = new Notification("Notificación de Leads", {
                            icon: "https://www.serviciosoportunidades.com/images/bolitas.png",
                            body: data.message.name + ' te ha sido asignado'
                        })
                        notificacion.onclick = function () {
                            window.open("https://www.serviciosoportunidades.com/Administrator/digitalchannelleads/" + data.message.id)
                        }
                    }
                }
                if (data.message.assessor_id === null && user.lead_area_id === data.message.lead_area_id) {
                  
                    if (Notification.permission !== "granted") {
                        Notification.requestPermission();
                    } else {
                        notificacion = new Notification("Notificación de Leads", {
                            icon: "https://www.serviciosoportunidades.com/images/bolitas.png",
                            body: data.message.name + ' ha sido asignado a tu área'
                        })

                        notificacion.onclick = function () {
                            window.open("https://www.serviciosoportunidades.com/Administrator/digitalchannelleads/" + data.message.id)
                        }
                    }
                }
            }
        });
                
</script>
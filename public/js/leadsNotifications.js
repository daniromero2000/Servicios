
$(document).ready(function () {
    // console.log("ready!");
    userArea = $("#authUserAreaId").val();
    // console.log($("#authUserAreaId").val())

    if (userArea != 0) {

        // console.log($("#authUserId").val())
        user = $("#authUserId").val();
        $.get('/getLeadNotifications/' + user + '', function (data) {
            // console.log(data);
            var html_notification = '';

            if (data.danger != '') {
                // console.log(data.danger);
                for (var i = 0; i < data.danger.length; i++) {
                    html_notification += '<a href="#" class="dropdown-item"> <div class="media"><div class="media-body"> <h3 class="dropdown-item-title"> ' + data.danger[i].nameLead + ' <span class="float-right text-sm text-danger" > <i class="fas fa-star"></i></span ></h3 > <p class="text-sm"> Ultima Actualización </p><p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> hace ' + data.danger[i].diference + '</p> </div > </div > </a > ';
                }
                // console.log(data.danger);

            }
            if (data.warning != '') {
                // console.log(data.warning);
                for (var i = 0; i < data.warning.length; i++) {
                    html_notification += '<a href="#" class="dropdown-item"> <div class="media"><div class="media-body"> <h3 class="dropdown-item-title"> ' + data.warning[i].nameLead + ' <span class="float-right text-sm text-warning" > <i class="fas fa-star"></i></span ></h3 > <p class="text-sm"> Ultima Actualización </p><p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> hace ' + data.warning[i].diference + '</p> </div > </div > </a > ';
                }
            }
            if (data.success != '') {
                for (var i = 0; i < data.success.length; i++) {
                    html_notification += '<a href="#" class="dropdown-item"> <div class="media"><div class="media-body"> <h3 class="dropdown-item-title"> ' + data.success[i].nameLead + ' <span class="float-right text-sm text-success" > <i class="fas fa-star"></i></span ></h3 > <p class="text-sm"> Ultima Actualización </p><p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>  hace ' + data.success[i].diference + '</p> </div > </div > </a > ';
                }
            }
            var totals = data.danger.length + data.warning.length + data.success.length;
            html_notification = html_notification != '' ? html_notification : '<a href="#" class="dropdown-item dropdown-footer">No tienes Notificaciónes</a>';
            $('#LeadsNotifications').html(html_notification);
            $('#totalNotifications').html(totals);
        });
    }

});

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
            if (data.expirationDateSoat != '') {
                for (var i = 0; i < data.expirationDateSoat.length; i++) {
                    html_notification += '<a href="/Administrator/digitalchannelleads/' + data.expirationDateSoat[i].id + '" class="dropdown-item p-0"> <div class="col-12 pl-2 pr-1 pt-0"> <div class="position-relative p-2" style="height: auto"><div class="ribbon-wrapper ribbon-lg"><div class="ribbon bg-warning"> SOAT </div></div> <div class="media mt-2 mb-1"><div class="media-body"> <h3 class="dropdown-item-title"> ' + data.expirationDateSoat[i].name + ' </h3 > <p class="text-sm"> Vencimiento de SOAT </p><p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>  En ' + data.expirationDateSoat[i].diference + '</p> </div > </div></div></div> </a>';
                }
            }
            if (data.danger != '') {
                // console.log(data.danger);
                for (var i = 0; i < data.danger.length; i++) {
                    html_notification += '<a href="/Administrator/digitalchannelleads/' + data.danger[i].lead_id + '" class="dropdown-item"> <div class="media"><div class="media-body"> <h3 class="dropdown-item-title"> ' + data.danger[i].nameLead + ' <span class="float-right text-sm text-danger" > <i class="fas fa-star"></i></span ></h3 > <p class="text-sm"> Ultima Actualización </p><p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Hace ' + data.danger[i].diference + '</p> </div > </div > </a > ';
                }
                // console.log(data.danger);

            }
            if (data.warning != '') {
                // console.log(data.warning);
                for (var i = 0; i < data.warning.length; i++) {
                    html_notification += '<a href="/Administrator/digitalchannelleads/' + data.warning[i].lead_id + '" class="dropdown-item"> <div class="media"><div class="media-body"> <h3 class="dropdown-item-title"> ' + data.warning[i].nameLead + ' <span class="float-right text-sm text-warning" > <i class="fas fa-star"></i></span ></h3 > <p class="text-sm"> Ultima Actualización </p><p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Hace ' + data.warning[i].diference + '</p> </div > </div > </a > ';
                }
            }
            if (data.success != '') {
                for (var i = 0; i < data.success.length; i++) {
                    html_notification += '<a href="/Administrator/digitalchannelleads/' + data.success[i].lead_id + '" class="dropdown-item"> <div class="media"><div class="media-body"> <h3 class="dropdown-item-title"> ' + data.success[i].nameLead + ' <span class="float-right text-sm text-success" > <i class="fas fa-star"></i></span ></h3 > <p class="text-sm"> Ultima Actualización </p><p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>  Hace ' + data.success[i].diference + '</p> </div > </div > </a > ';
                }
            }

            var totals = data.danger.length + data.warning.length + data.success.length + data.expirationDateSoat.length;
            html_notification = html_notification != '' ? html_notification : '<a href="#" class="dropdown-item dropdown-footer">No tienes Notificaciónes</a>';
            $('#LeadsNotifications').html(html_notification);
            $('#totalNotifications').html(totals);
        });
    }

});
$(document).ready(function () {
    $(function () {
        $("#search").click(getCode);
    });
    function getCode() {
        var identificationNumber = $('#identificationNumber').val();
        console.log(identificationNumber);
        $.get('/api/customer/CodeVerification/' + identificationNumber, function (data) {
            console.log(data)

            if (data[0] != '') {
                html = [];
                $('#my-modal').modal('show')
                for (var i = 0; i < data[0].length; i++) {
                    html += ' <tr> <td>' + data[0][i].token + ' </td>' + '<td>' + data[0][i].identificationNumber + ' </td>' + '<td>' + data[0][i].telephone + ' </td>' + '<td>' + data[0][i].type + ' </td>' + '<td>' + data[0][i].created_at + ' </td>' + '<td>' + data[0][i].state + ' </td> </tr>';
                }
                $('#dataCode').html(html);
            }
            else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                });
                Toast.fire({
                    type: 'error',
                    title: 'No hay ningun token generado el dia de hoy o no existe el cliente'
                })
            }
        });
    }

});
$(function () {
    var typeNotification = $('#notification').val();

    // alert(typeNotification)
    if (typeNotification == 1) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
        });
        Toast.fire({
            type: 'error',
            title: 'Los datos no se encuentran registrados en nuestras base de datos.'
        })
    }

    if (typeNotification == 2) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
        });
        Toast.fire({
            type: 'success',
            title: 'Los datos han sido actualizados correctamente.'
        })
    }
});
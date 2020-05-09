function showAlert(type, messagge){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
    });
    Toast.fire({
        type: type,
        title: messagge
    });
}
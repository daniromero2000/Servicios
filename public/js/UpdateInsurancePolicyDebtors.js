$(function () {
    $("#debtor").click(ontypeServiceSelectedProductEditModal);
});
$(function () {
    $("#debtorOportuya").click(ontypedebtorOportuya);
});

function ontypeServiceSelectedProductEditModal() {
    var typeServiceCreateSelected_id = $('#soliDebtor').val();
    console.log(typeServiceCreateSelected_id);
    $.get('/getPoliceDebtors/' + typeServiceCreateSelected_id + '', function (data) {
        console.log(data)
        $('#solic').val('').prop("disabled", true);
        $('#identification').val('').prop("disabled", true);
        $('#sucursalCustomer').val('').prop("disabled", true);
        $('#identificationNumberDebtor').val('').prop("disabled", true);
        $('#nameDebtor').val('').prop("disabled", true);
        $('#parenterDebtor').val('').prop("disabled", true);
        $('.btn-disabled-desicion').val('').prop("disabled", true);

        if (data == '') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                type: 'error',
                title: 'No existe ningún beneficiario vinculado a esta solicitud.'
            })
        } else {
            html_selectEdit = [];
            $('#solic').val(typeServiceCreateSelected_id).prop("disabled", false);
            $('#identification').val(data.CEDULA).prop("disabled", false);
            $('#sucursalCustomer').val(data.SUCURSAL).prop("disabled", false);
            $('#identificationNumberDebtor').val(data.CEDULA_BEN).prop("disabled", false);
            $('#nameDebtor').val(data.BENEFIC).prop("disabled", false);
            $('#parenterDebtor').prop("disabled", false);
            $('.btn-disabled-desicion').val('').prop("disabled", false);
            html_selectEdit = '<option value="' + data.PARENTESCO + '" selected="selected" >' + data.PARENTESCO + '</option>';
            html_selectEdit += '<option value="HERMANOS">' + "HERMANOS" + '</option>';
            html_selectEdit += '<option value="YERNO">' + "YERNO" + '</option>';
            html_selectEdit += '<option value="PADRES">' + "PADRES" + '</option>';
            html_selectEdit += '<option value="HIJOS">' + "HIJOS" + '</option>';
            html_selectEdit += '<option value="TIOS">' + "TIOS" + '</option>';
            html_selectEdit += '<option value="PRIMOS">' + "PRIMOS" + '</option>';
            html_selectEdit += '<option value="SOBRINOS">' + "SOBRINOS" + '</option>';
            html_selectEdit += '<option value="CUÑADOS">' + "CUÑADOS" + '</option>';
            html_selectEdit += '<option value="AMIGOS">' + "AMIGOS" + '</option>';
            html_selectEdit += '<option value="SUEGROS">' + "SUEGROS" + '</option>';
            html_selectEdit += '<option value="ABUELOS">' + "ABUELOS" + '</option>';
            html_selectEdit += '<option value="ESPOSA">' + "ESPOSA" + '</option>';
            html_selectEdit += '<option value="NIETOS">' + "NIETOS" + '</option>';
            $('#parenterDebtor').html(html_selectEdit);
        }
    });
}
function ontypedebtorOportuya() {
    var typeServiceCreateSelected_id = $('#identificationOportuya').val();
    console.log(typeServiceCreateSelected_id);
    $.get('/getPoliceDebtorOportuyas/' + typeServiceCreateSelected_id + '', function (data) {
        console.log(data)
        $('#customerOportuya').val('').prop("disabled", true);
        $('#sucursalCustomerOportuya').val('').prop("disabled", true);
        $('#identificationNumberDebtorOportuya').val('').prop("disabled", true);
        $('#nameDebtorOportuya').val('').prop("disabled", true);
        $('#parenterDebtorOportuya').val('').prop("disabled", true);
        $('.btn-disabled-desicion-opo').val('').prop("disabled", true);

        if (data == '') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                type: 'error',
                title: 'No existe ningún beneficiario vinculado a este cliente.'
            })
        } else {
            html_selectEdit = [];
            $('#parenterDebtorOportuya').prop("disabled", false);
            $('#customerOportuya').val(typeServiceCreateSelected_id).prop("disabled", false);
            $('#sucursalCustomerOportuya').val(data.SUCURSAL).prop("disabled", false);
            $('#identificationNumberDebtorOportuya').val(data.CEDULA_BEN).prop("disabled", false);
            $('#nameDebtorOportuya').val(data.BENEFIC).prop("disabled", false);
            $('.btn-disabled-desicion-opo').val('').prop("disabled", false);
            html_selectEdit = '<option value="' + data.PARENTESCO + '" selected="selected" >' + data.PARENTESCO + '</option>';
            html_selectEdit += '<option value="HERMANOS">' + "HERMANOS" + '</option>';
            html_selectEdit += '<option value="YERNO">' + "YERNO" + '</option>';
            html_selectEdit += '<option value="PADRES">' + "PADRES" + '</option>';
            html_selectEdit += '<option value="HIJOS">' + "HIJOS" + '</option>';
            html_selectEdit += '<option value="TIOS">' + "TIOS" + '</option>';
            html_selectEdit += '<option value="PRIMOS">' + "PRIMOS" + '</option>';
            html_selectEdit += '<option value="SOBRINOS">' + "SOBRINOS" + '</option>';
            html_selectEdit += '<option value="CUÑADOS">' + "CUÑADOS" + '</option>';
            html_selectEdit += '<option value="AMIGOS">' + "AMIGOS" + '</option>';
            html_selectEdit += '<option value="SUEGROS">' + "SUEGROS" + '</option>';
            html_selectEdit += '<option value="ABUELOS">' + "ABUELOS" + '</option>';
            html_selectEdit += '<option value="ESPOSA">' + "ESPOSA" + '</option>';
            html_selectEdit += '<option value="NIETOS">' + "NIETOS" + '</option>';
            $('#parenterDebtorOportuya').html(html_selectEdit);
        }
    });
}


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
        html_selectEdit = [];

        $('#solic').val(typeServiceCreateSelected_id);
        $('#identification').val(data.CEDULA);
        $('#sucursalCustomer').val(data.SUCURSAL);
        $('#identificationNumberDebtor').val(data.CEDULA_BEN);
        $('#nameDebtor').val(data.BENEFIC);
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
    });
}

function ontypedebtorOportuya() {
    var typeServiceCreateSelected_id = $('#identificationOportuya').val();
    console.log(typeServiceCreateSelected_id);
    $.get('/getPoliceDebtorOportuyas/' + typeServiceCreateSelected_id + '', function (data) {
        console.log(data)
        html_selectEdit = [];

        $('#customerOportuya').val(typeServiceCreateSelected_id);
        $('#sucursalCustomerOportuya').val(data.SUCURSAL);
        $('#identificationNumberDebtorOportuya').val(data.CEDULA_BEN);
        $('#nameDebtorOportuya').val(data.BENEFIC);
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
    });
}


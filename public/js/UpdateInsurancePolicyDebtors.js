$(function () {
    $("#debtor").click(ontypeServiceSelectedProductEditModal);
});
function ontypeServiceSelectedProductEditModal() {
    var typeServiceCreateSelected_id = $('#identification').val();
    console.log(typeServiceCreateSelected_id);
    $.get('/getPoliceDebtors/' + typeServiceCreateSelected_id + '', function (data) {
        console.log(data)
        html_selectEdit = [];

        $('#customer').val(typeServiceCreateSelected_id);
        $('#solicDebtor').val(data.SOLIC);
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

$(function () {
    $("#typeClients").on('change', ontypeAreaSelectCreate);
});

function ontypeAreaSelectCreate() {
    console.log($("#typeClients").val());
    if ($("#typeClients").val() == "Tradicional") {
        var html_selectEdit = '<button type="button" id="debtor" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Buscar</button>';
    }
    if ($("#typeClients").val() == "Oportuya") {
        var html_selectEdit = '<button type="button" id="debtorOportuya" data-toggle="modal" data-target="#exampleModals" class="btn btn-info">Buscar</button>';
    }
    $('#ButtonCustomerSearch').html(html_selectEdit);

    //     var typeServiceCreateSelected_id = $(this).val();
    //     if (!typeServiceCreateSelected_id) {
    //         $('#typeProductCreate').html('<option value=""> -- Selecciona Producto -- </option>');
    //     }
    //     $.get('/getproducts/' + typeServiceCreateSelected_id + '', function (data) {
    //         var html_selectEdit = '<option disabled selected value> -- Selecciona Producto -- </option>';
    //         for (var i = 0; i < data.length; i++) {
    //             html_selectEdit += '<option value="' + data[i].id + '">' + data[i].lead_product + '</option>';
    //         }
    //         $('#typeProductCreate').html(html_selectEdit);
    //     });
    //     $.get('/getServices/' + typeServiceCreateSelected_id + '', function (data) {
    //         var html_selectEdit = '<option disabled selected value> -- Selecciona Servicio -- </option>';
    //         for (var i = 0; i < data.length; i++) {
    //             html_selectEdit += '<option value="' + data[i].id + '">' + data[i].service + '</option>';
    //         }
    //         $('#typeServiceSelectedCreate').html(html_selectEdit);
    //     });
    //     $.get('/getAssessors/' + typeServiceCreateSelected_id + '', function (data) {
    //         var html_selectEdit = '<option data-select3-id="" disabled selected value> -- Selecciona Asesor -- </option>'

    //         for (var i = 0; i < data.length; i++) {
    //             html_selectEdit += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
    //         }
    //         $('#selectAssessorCreate').html(html_selectEdit);
    //     });
    // }
}

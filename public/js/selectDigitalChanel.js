
$(function () {
    $("#typeServiceSelected").on('change', ontypeServiceSelected)
});

function ontypeServiceSelected() {
    var typeServiceSelected_id = $(this).val();
    console.log(typeServiceSelected_id)

    if (!typeServiceSelected_id) {
        $('#typeProductselect').html('<option value=""> -- Selecciona Producto -- </option>');

    }

    $.get('/getproducts/' + typeServiceSelected_id + '', function (data) {
        var html_select = '<option value=""> -- Selecciona Producto -- </option>';
        for (var i = 0; i < data.length; i++) {
            html_select += '<option value="' + data[i].id + '">' + data[i].lead_product + '</option>';
            $('#typeProductselect').html(html_select);
        }

    })
}


$(function () {
    $("#typeServiceSelected").on('change', ontypeServiceSelected)
});

function ontypeServiceSelected() {
    var typeServiceSelected_id = $(this).val();
    console.log(typeServiceSelected_id)

    if (!typeServiceSelected_id) {
        $('#stateSelect').html('<option value=""> -- Selecciona Producto -- </option>');

    }

    $.get('/getStatuses/' + typeServiceSelected_id + '', function (data) {
        var html_select = '<option value=""> -- Selecciona Producto -- </option>';
        for (var i = 0; i < data.length; i++) {
            html_select += '<option value="' + data[i].id + '">' + data[i].status + '</option>';
            $('#stateSelect').html(html_select);
        }

    })
}
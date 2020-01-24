
$(function () {
    $("#typeServiceSelectedCreate").on('change', ontypeServiceSelectedCreate)
});

function ontypeServiceSelectedCreate() {
    var typeServiceCreateSelected_id = $(this).val();

    if (!typeServiceCreateSelected_id) {
        $('#typeProductselect').html('<option value=""> -- Selecciona Producto -- </option>');

    }

    $.get('/getproducts/' + typeServiceCreateSelected_id + '', function (data) {
        console.log(data)

        var html_selectCreate = '<option value=""> -- Selecciona Producto -- </option>';
        for (var i = 0; i < data.length; i++) {
            html_selectCreate += '<option value="' + data[i].id + '">' + data[i].lead_product + '</option>';
        }
        $('#typeProductselect').html(html_selectCreate);

    })
}

$(function () {
    $("#typeServiceSelectedEdit").on('change', ontypeServiceSelectedEdit)
});

function ontypeServiceSelectedEdit() {
    var typeServiceEditSelected_id = $(this).val();

    if (!typeServiceEditSelected_id) {
        $('#stateSelect').html('<option value=""> -- Selecciona Producto -- </option>');

    }

    $.get('/getStatuses/' + typeServiceEditSelected_id + '', function (data) {
        var html_selectEdit = '<option value=""> -- Selecciona Producto -- </option>';
        for (var i = 0; i < data.length; i++) {
            html_selectEdit += '<option value="' + data[i].id + '">' + data[i].status + '</option>';
        }
        $('#stateSelect').html(html_selectEdit);
    })
}

$(function () {
    $("#typeServiceSelectedEdit").on('change', ontypeServiceSelectedEditProduct)
});

function ontypeServiceSelectedEditProduct() {
    var typeServiceEditSelected_id = $(this).val();

    if (!typeServiceEditSelected_id) {
        $('#typeProductselectedit').html('<option value=""> -- Selecciona Producto -- </option>');

    }

    $.get('/getproducts/' + typeServiceEditSelected_id + '', function (data) {
        var html_selectEdit = '<option value=""> -- Selecciona Producto -- </option>';
        for (var i = 0; i < data.length; i++) {
            html_selectEdit += '<option value="' + data[i].id + '">' + data[i].lead_product + '</option>';
        }
        $('#typeProductselectedit').html(html_selectEdit);
    })
}
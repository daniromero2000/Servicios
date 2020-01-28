
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
        $('#stateSelect').html('<option value=""> -- Selecciona Estado -- </option>');

    }

    $.get('/getStatuses/' + typeServiceEditSelected_id + '', function (data) {
        var html_selectEdit = '<option value=""> -- Selecciona Estado -- </option>';
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



$(function () {
    $(".fa-edit").click(ontypeServiceSelectedEditModal);
});

$(function () {
    $(".fa-edit").click(ontypeServiceSelectedProductEditModal);
});

$(function () {
    $("#edit_show").click(ontypeServiceSelectedEditModal);
});

$(function () {
    $("#edit_show").click(ontypeServiceSelectedProductEditModal);
});

function ontypeServiceSelectedProductEditModal() {
    var typeServiceEditSelected_id = $("#typeServiceSelectedEdit").val();
    $.get('/getproducts/' + typeServiceEditSelected_id + '', function (data) {
        var html_selectEdit = $('#typeProductselectedit').html();
        for (var i = 0; i < data.length; i++) {
            html_selectEdit += '<option value="' + data[i].id + '">' + data[i].lead_product + '</option>';
        }
        $('#typeProductselectedit').html(html_selectEdit);
    });
};

function ontypeServiceSelectedEditModal() {
    var typeServiceEditSelected_id = $("#typeServiceSelectedEdit").val();
    if (!typeServiceEditSelected_id) {
        $('#stateSelect').html('<option value=""> -- Selecciona Producto -- </option>');

    }

    $.get('/getStatuses/' + typeServiceEditSelected_id + '', function (data) {
        var html_selectEdit = '<option value=""> -- Selecciona Estado -- </option>';
        for (var i = 0; i < data.length; i++) {
            html_selectEdit += '<option value="' + data[i].id + '">' + data[i].status + '</option>';
        }
        $('#stateSelect').html(html_selectEdit);
    });
};


$(function () {
    $("#typeAreaSelectFilter").on('change', ontypeAreaSelectFilter)
});

function ontypeAreaSelectFilter() {
    var typeAreaSelectFilter_id = $(this).val();
    console.log(typeAreaSelectFilter_id);
    if (!typeAreaSelectFilter_id) {
        $('#stateSelectFilter').html('<option value=""> -- Selecciona Producto -- </option>');

    }

    $.get('/getStatuses/' + typeAreaSelectFilter_id + '', function (data) {
        var html_selectEdit = '<option disabled selected value> -- Selecciona Estado -- </option>';
        for (var i = 0; i < data.length; i++) {
            html_selectEdit += '<option value="' + data[i].id + '">' + data[i].status + '</option>';
        }
        $('#stateSelectFilter').html(html_selectEdit);
    });

    $.get('/getServices/' + typeAreaSelectFilter_id + '', function (data) {
        var html_selectEdit = '<option disabled selected value> -- Selecciona Servicio -- </option>';
        for (var i = 0; i < data.length; i++) {
            html_selectEdit += '<option value="' + data[i].id + '">' + data[i].service + '</option>';
        }
        $('#typeServiceFilter').html(html_selectEdit);
    });

    $.get('/getproducts/' + typeAreaSelectFilter_id + '', function (data) {
        var html_selectEdit = '<option disabled selected value> -- Selecciona Producto -- </option>';
        for (var i = 0; i < data.length; i++) {
            html_selectEdit += '<option value="' + data[i].id + '">' + data[i].lead_product + '</option>';
        }
        $('#typeProductFilter').html(html_selectEdit);
    });



};
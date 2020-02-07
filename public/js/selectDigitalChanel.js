$(function () {
    $("#typeAreaSelectCreate").on('change', ontypeAreaSelectCreate)
});
function ontypeAreaSelectCreate() {
    var typeServiceCreateSelected_id = $(this).val();
    if (!typeServiceCreateSelected_id) {
        $('#typeProductCreate').html('<option value=""> -- Selecciona Producto -- </option>');
    }
    $.get('/getproducts/' + typeServiceCreateSelected_id + '', function (data) {
        var html_selectEdit = '<option disabled selected value> -- Selecciona Producto -- </option>';
        for (var i = 0; i < data.length; i++) {
            html_selectEdit += '<option value="' + data[i].id + '">' + data[i].lead_product + '</option>';
        }
        $('#typeProductCreate').html(html_selectEdit);
    });
    $.get('/getServices/' + typeServiceCreateSelected_id + '', function (data) {
        var html_selectEdit = '<option disabled selected value> -- Selecciona Servicio -- </option>';
        for (var i = 0; i < data.length; i++) {
            html_selectEdit += '<option value="' + data[i].id + '">' + data[i].service + '</option>';
        }
        $('#typeServiceSelectedCreate').html(html_selectEdit);
    });
    $.get('/getAssessors/' + typeServiceCreateSelected_id + '', function (data) {
        var html_selectEdit = '<option data-select3-id="" disabled selected value> -- Selecciona Asesor -- </option>'

        for (var i = 0; i < data.length; i++) {
            html_selectEdit += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
        }
        $('#selectAssessorCreate').html(html_selectEdit);
    });
}
$(function () {
    $("#edit_show").click(ontypeServiceSelectedProductEditModal);
});
function dataLead(dataId) {
    ontypeServiceSelectedProductEditModal(dataId)

}

function ontypeServiceSelectedProductEditModal(dataId) {
    var typeServiceEditSelected_id = $("#typeAreaSelectEdit" + dataId).val();
    $('#editLead' + dataId).modal({ backdrop: 'static', keyboard: false })

    $.get('/getproducts/' + typeServiceEditSelected_id + '', function (data) {

        var html_selectEdit = ""
        for (var i = 0; i < data.length; i++) {
            if ($('#typeProductselectedit' + dataId).val() == data[i].id) {
                html_selectEdit = '<option value="' + data[i].id + '" disabled selected="selected">' + data[i].lead_product + '</option>';
            }
            html_selectEdit += '<option value="' + data[i].id + '" ">' + data[i].lead_product + '</option>';
        }
        $('#typeProductselectedit' + dataId).html(html_selectEdit);
    });
    $.get('/getServices/' + typeServiceEditSelected_id + '', function (data) {
        var html_selectEdit = "";
        for (var i = 0; i < data.length; i++) {
            if ($('#typeServiceSelectedEdit' + dataId).val() == data[i].id) {
                html_selectEdit += '<option value="' + data[i].id + '" disabled selected="selected" ">' + data[i].service + '</option>';
            }
            html_selectEdit += '<option value="' + data[i].id + '" ">' + data[i].service + '</option>';
        }
        $('#typeServiceSelectedEdit' + dataId).html(html_selectEdit);
    });
    $.get('/getStatuses/' + typeServiceEditSelected_id + '', function (data) {
        var html_selectEdit = "";
        for (var i = 0; i < data.length; i++) {
            if ($('#stateSelectEdit' + dataId).val() == data[i].id) {
                html_selectEdit += '<option value="' + data[i].id + '"  selected="selected" ">' + data[i].status + '</option>';
            }
            html_selectEdit += '<option value="' + data[i].id + '" ">' + data[i].status + '</option>';
        }
        $('#stateSelectEdit' + dataId).html(html_selectEdit);
    });
    $.get('/getAssessors/' + typeServiceEditSelected_id + '', function (data) {
        var html_selectEdit = "";
        for (var i = 0; i < data.length; i++) {

            if ($('#selectAssessorEdit' + dataId).val() == data[i].id) {
                html_selectEdit += '<option value="' + data[i].id + '" disabled selected="selected" ">' + data[i].name + '</option>';
            }
            html_selectEdit += '<option value="' + data[i].id + '"  ">' + data[i].name + '</option>';
        }
        $('#selectAssessorEdit' + dataId).html(html_selectEdit);
    });
};
$(function () {
    $("#typeAreaSelectFilter").on('change', ontypeAreaSelectFilter)
});
function ontypeAreaSelectFilter() {
    var typeAreaSelectFilter_id = $(this).val();
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

    $.get('/getAssessors/' + typeAreaSelectFilter_id + '', function (data) {
        var html_selectEdit = '<option disabled selected value> -- Selecciona Asesor -- </option>';
        for (var i = 0; i < data.length; i++) {
            html_selectEdit += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
        }
        $('#assessorSelectFilter').html(html_selectEdit);
    });
};
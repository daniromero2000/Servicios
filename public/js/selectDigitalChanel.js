$(function () {
    $("#typeAreaSelectCreate").on('change', ontypeAreaSelectCreate)
});

$(function () {
    $("#subsidary").on('change', ontypeAreaSelectCreate)
});
if ($('#typeProductCreate').val() == 27) {
    $('#fechExpirationCreate').show();
} else {
    $('#fechExpirationCreate').hide();
}

if ($('#typeAreaSelectCreate').val() == 11) {
    $('#SubsidiaryCreate').show();
} else {
    $('#SubsidiaryCreate').hide();
}
function ontypeAreaSelectCreate() {
    var typeServiceCreateSelected_id = $("#typeAreaSelectCreate").val();
    if (typeServiceCreateSelected_id == 11) {
        $('#SubsidiaryCreate').show();
    } else {
        $('#SubsidiaryCreate').hide();
    }

    if (!typeServiceCreateSelected_id) {
        $('#typeProductCreate').html('<option value="">  Selecciona Producto  </option>');
    }
    $.get('/getproducts/' + typeServiceCreateSelected_id + '', function (data) {
        var html_selectEdit = '<option  selected value>  Selecciona Producto  </option>';
        for (var i = 0; i < data.length; i++) {
            html_selectEdit += '<option value="' + data[i].id + '">' + data[i].lead_product + '</option>';
        }
        $('#typeProductCreate').html(html_selectEdit);

        $("#typeProductCreate").change(function () {
            if ($('#typeProductCreate').val() == 27) {
                $('#fechExpirationCreate').show();
            } else {
                $('#fechExpirationCreate').hide();
            }
        });
    });
    $.get('/getServices/' + typeServiceCreateSelected_id + '', function (data) {
        var html_selectEdit = '<option  selected value>  Selecciona Servicio  </option>';
        for (var i = 0; i < data.length; i++) {
            html_selectEdit += '<option value="' + data[i].id + '">' + data[i].service + '</option>';
        }
        $('#typeServiceSelectedCreate').html(html_selectEdit);
    });
    if (typeServiceCreateSelected_id == 11 && $('#subsidary').val() != '') {

        var subsidary = $('#subsidary').val();
        $.get('/getAssessors/' + typeServiceCreateSelected_id + '?q=&subsidiary=' + subsidary, function (data) {
            var html_selectEdit = '<option data-select3-id=""  selected value>  Selecciona Asesor  </option>'
            for (var i = 0; i < data.length; i++) {
                html_selectEdit += '<option value="' + data[i].user.id + '">' + data[i].user.name + '</option>';
            }
            $('#selectAssessorCreate').html(html_selectEdit);
        });
    } else {
        $.get('/getAssessors/' + typeServiceCreateSelected_id + '', function (data) {
            var html_selectEdit = '<option data-select3-id=""  selected value>  Selecciona Asesor  </option>'

            for (var i = 0; i < data.length; i++) {
                html_selectEdit += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
            }
            $('#selectAssessorCreate').html(html_selectEdit);
        });
    }
}

$(function () {
    $("#edit_show").click(ontypeServiceSelectedProductEditModal);
});

function dataLead(dataId) {
    user = $("#idProfile").val();
    if (user != 16 || user != 4) {
        $("#typeAreaSelectEdit" + dataId).prop("disabled", true);
        $("#channel" + dataId).prop("disabled", true);
    }
    ontypeServiceSelectedProductEditModal(dataId)

}

function ontypeServiceSelectedProductEditModal(dataId) {
    var typeServiceEditSelected_id = $("#typeAreaSelectEdit" + dataId).val();
    $.get('/getproducts/' + typeServiceEditSelected_id + '', function (data) {
        var html_selectEdit = ""
        for (var i = 0; i < data.length; i++) {
            if ($('#typeProductselectedit' + dataId).val() == data[i].id) {
                html_selectEdit = '<option value="' + data[i].id + '"  selected="selected">' + data[i].lead_product + '</option>';
            }
            html_selectEdit += '<option value="' + data[i].id + '" ">' + data[i].lead_product + '</option>';
        }
        $('#typeProductselectedit' + dataId).html(html_selectEdit);

        if ($('#typeProductselectedit' + dataId).val() == 27) {
            $('#fechExpiration' + dataId).show();
        } else {
            $('#fechExpiration' + dataId).hide();
        }

        if ($("#typeAreaSelectEdit" + dataId).val() == 11) {
            $('#SubsidiaryEdit' + dataId).show();
        } else {
            $('#SubsidiaryEdit' + dataId).hide();
        }

        $('#typeProductselectedit' + dataId).change(function () {
            if ($('#typeProductselectedit' + dataId).val() == 27) {
                $('#fechExpiration' + dataId).show();
            } else {
                $('#fechExpiration' + dataId).hide();
            }

            if ($("#typeAreaSelectEdit" + dataId).val() == 11) {
                $('#SubsidiaryEdit' + dataId).show();
            } else {
                $('#SubsidiaryEdit' + dataId).hide();
            }
        });

    });
    $.get('/getServices/' + typeServiceEditSelected_id + '', function (data) {
        var html_selectEdit = "";
        for (var i = 0; i < data.length; i++) {
            if ($('#typeServiceSelectedEdit' + dataId).val() == data[i].id) {
                html_selectEdit += '<option value="' + data[i].id + '"  selected="selected" ">' + data[i].service + '</option>';
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

    if (typeServiceEditSelected_id == 11 && $('#subsidary' + dataId).val() != '') {

        var subsidary = $('#subsidary' + dataId).val();

        $.get('/getAssessors/' + typeServiceEditSelected_id + '?q=&subsidiary=' + subsidary, function (data) {
            var html_selectEdit = "";
            for (var i = 0; i < data.length; i++) {

                if ($('#selectAssessorEdit' + dataId).val() == data[i].user.id) {
                    html_selectEdit += '<option value="' + data[i].user.id + '"  selected="selected" ">' + data[i].user.name + '</option>';
                }
                html_selectEdit += '<option value="' + data[i].user.id + '"  ">' + data[i].user.name + '</option>';
            }
            $('#selectAssessorEdit' + dataId).html(html_selectEdit);
        });
    } else {
        $.get('/getAssessors/' + typeServiceEditSelected_id + '', function (data) {
            var html_selectEdit = "";
            for (var i = 0; i < data.length; i++) {

                if ($('#selectAssessorEdit' + dataId).val() == data[i].id) {
                    html_selectEdit += '<option value="' + data[i].id + '"  selected="selected" ">' + data[i].name + '</option>';
                }
                html_selectEdit += '<option value="' + data[i].id + '"  ">' + data[i].name + '</option>';
            }
            $('#selectAssessorEdit' + dataId).html(html_selectEdit);
        });
    }

    $('#subsidary' + dataId).change(function () {
        var subsidary = $('#subsidary' + dataId).val();
        $.get('/getAssessors/' + typeServiceEditSelected_id + '?q=&subsidiary=' + subsidary, function (data) {
            var html_selectEdit = "";
            for (var i = 0; i < data.length; i++) {

                if ($('#selectAssessorEdit' + dataId).val() == data[i].user.id) {
                    html_selectEdit += '<option value="' + data[i].user.id + '"  selected="selected" ">' + data[i].user.name + '</option>';
                }
                html_selectEdit += '<option value="' + data[i].user.id + '"  ">' + data[i].user.name + '</option>';
            }
            $('#selectAssessorEdit' + dataId).html(html_selectEdit);
        });
    });

};
$(function () {
    $("#typeAreaSelectFilter").on('change', ontypeAreaSelectFilter)
});

$(function () {
    $("#subsidiaryCode").on('change', ontypeAreaSelectFilter)
});

if ($('#typeAreaSelectFilter').val() == 11) {
    $('#subsidiaryFilter').show();
    ontypeAreaSelectFilter();
} else {
    $('#subsidiaryFilter').hide();
}
function ontypeAreaSelectFilter() {
    var typeAreaSelectFilter_id = $('#typeAreaSelectFilter').val();
    if (!typeAreaSelectFilter_id) {
        $('#stateSelectFilter').html('<option value="">  Selecciona Producto  </option>');
    }
    $.get('/getStatuses/' + typeAreaSelectFilter_id + '', function (data) {
        var html_selectEdit = '<option selected value>  Selecciona Estado  </option>';
        for (var i = 0; i < data.length; i++) {
            html_selectEdit += '<option value="' + data[i].id + '">' + data[i].status + '</option>';
        }
        $('#stateSelectFilter').html(html_selectEdit);
    });
    $.get('/getServices/' + typeAreaSelectFilter_id + '', function (data) {
        var html_selectEdit = '<option selected value>  Selecciona Servicio  </option>';
        for (var i = 0; i < data.length; i++) {
            html_selectEdit += '<option value="' + data[i].id + '">' + data[i].service + '</option>';
        }
        $('#typeServiceFilter').html(html_selectEdit);
    });
    $.get('/getproducts/' + typeAreaSelectFilter_id + '', function (data) {
        var html_selectEdit = '<option selected value>  Selecciona Producto  </option>';
        for (var i = 0; i < data.length; i++) {
            html_selectEdit += '<option value="' + data[i].id + '">' + data[i].lead_product + '</option>';
        }
        $('#typeProductFilter').html(html_selectEdit);
    });

    if ($('#typeAreaSelectFilter').val() == 11) {
        $('#subsidiaryFilter').show();
    } else {
        $('#subsidiaryFilter').hide();
    }
    if (typeAreaSelectFilter_id == 11 && $('#subsidiaryCode').val() != '') {

        var subsidary = $('#subsidiaryCode').val();
        $.get('/getAssessors/' + typeAreaSelectFilter_id + '?q=&subsidiary=' + subsidary, function (data) {
            var html_selectEdit = '<option data-select3-id=""  selected value>  Selecciona Asesor  </option>'
            for (var i = 0; i < data.length; i++) {
                html_selectEdit += '<option value="' + data[i].user.id + '">' + data[i].user.name + '</option>';
            }
            $('#assessorSelectFilter').html(html_selectEdit);
        });
    } else {
        $.get('/getAssessors/' + typeAreaSelectFilter_id + '', function (data) {
            var html_selectEdit = '<option data-select3-id=""  selected value>  Selecciona Asesor  </option>'

            for (var i = 0; i < data.length; i++) {
                html_selectEdit += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
            }
            $('#assessorSelectFilter').html(html_selectEdit);
        });
    }
};

function loadLead() {
    var leadTelephone = $("#telephoneCreate").val();
    $.get('/getLead/' + leadTelephone + '', function (data) {
        if (data != 'false') {
            $("#identificationNumberCreate").val(data.identificationNumber);
            $("#nameCreate").val(data.name);
            $("#lastNameCreate").val(data.lastName);
            $("#emailCreate").val(data.email);
        }
    });
};

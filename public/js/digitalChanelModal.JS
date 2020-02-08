function loadLead() {

    var leadTelephone = $("#telephoneCreate").val();
    $.get('/getLead/' + leadTelephone + '', function (data) {
        if (data != 'false') {
            $("#identificationNumberCreate").val(data.identificationNumber);
            $("#nameCreate").val(data.name);
            $("#lastNameCreate").val(data.lastName);
            $("#emailCreate").val(data.email);
        } else {
            $("#identificationNumberCreate").val("");
            $("#nameCreate").val("");
            $("#lastNameCreate").val("");
            $("#emailCreate").val("");
        }
    });
}

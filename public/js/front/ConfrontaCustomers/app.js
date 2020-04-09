$(document).ready(function () {
    $('#confrontaForm').hide();

    $(function () {
        var typeNotification = $('#notification').val();

        // alert(typeNotification)
        if (typeNotification == 1) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
            });
            Toast.fire({
                type: 'error',
                title: 'Los datos no se encuentran registrados en nuestras base de datos.'
            })
        }

        if (typeNotification == 2) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
            });
            Toast.fire({
                type: 'success',
                title: 'Los datos han sido actualizados correctamente.'
            })
        }
    });


    $("#confronta").click(function () {

        var identification = $('#CEDULA').val();
        $.get("/confrontInHouse/" + identification, function (data) {
            setTimeout(() => {
                $('#confrontaForm').hide();
                var htmlConfronta = '<div class="spinner-border text-primary" role="status"> <span class="sr-only">Loading...</span> </div> <br> <span>Cargando...</span>';
                $('#response').html(htmlConfronta);

            }, 3000);
            console.log(data.questions)
            var htmlConfronta = '<div class="text-left"> <form id="formQuestions"> <input type="text" value="' + data.formId + '" name="formId" hidden>'
            var formulario = ""

            for (var i = 0; i < data.questions.length; i++) {
                console.log(data.questions[i].options.length)
                // htmlConfronta += '<div class="form-group pl-4 pr-4"> <h5 >' + data.questions[i].question + '</h5>  <input type="text" name="question_id" value="' + data.questions[i].question_id + '" hidden >';
                htmlConfronta += '<div class="form-group pl-4 pr-4"> <h5 >' + data.questions[i].question + '</h5> ';


                formulario += htmlConfronta

                for (var d = 0; d < data.questions[i].options.length; d++) {
                    htmlConfronta += '<div class="custom-control custom-radio"> <input class="custom-control-input" type="radio" value="' + data.questions[i].options[d].optionId + '" id="customRadio' + i + '' + d + '" name="' + data.questions[i].question_id + '"> <label for="customRadio' + i + '' + d + '" class="custom-control-label" style="line-height: unset; font-size: 14px;">' + data.questions[i].options[d].option + '</label>  </div>'

                }
                htmlConfronta += '</div>';


            }

            htmlConfronta += '<div class="row"> <div class="col-12 text-center"> </div> </div> </form> </div>';

            formulario = htmlConfronta

            $('#confrontaForm').show();

            $('#response').html(formulario);


        });
    });


    $("#confrontaForm").click(function () {

        console.log($("#formQuestions").serializeArray());
        var headers = { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') };

        $.ajax({
            url: '/confrontInHouse',
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: { message: $("#formQuestions").serializeArray() },
            success: function (response) {
                console.log(response);
            }
        });

    });


});
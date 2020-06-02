$(document).ready(function () {
    $('#confrontaForm').hide();
    $('#updateData').hide();
    $('#updateDataFailed').hide();
    // $('#updateDataFailed').show();
    $(function () {
        var typeNotification = $('#notification').val();

        if (typeNotification == 1) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
            });
            Toast.fire({
                type: 'error',
                title: 'Datos incorrectos.'
            })
        }

        if (typeNotification == 2) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
            });
            Toast.fire({
                type: 'error',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        }
        if (typeNotification == 3) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
            });
            Toast.fire({
                type: 'warning',
                title: 'No puedes hacer mas intentos por hoy.'
            })
        }
    });



    $("#confronta").click(function () {

        var identification = $('#CEDULA').val();
        if ($("#CELULAR").val() == '' || $("#DIRECCION").val() == '' || $("#EMAIL").val() == '') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
            });
            Toast.fire({
                type: 'error',
                title: 'Todos los campos son requeridos.'
            })
        } else {
            $.get("/confrontInHouse/" + identification, function (data) {
                if (data != 'false') {
                    startTimer();

                    var htmlConfronta = '<label for="">Este formulario tiene un tiempo máximo de 2 minutos para ser diligenciado <span class="color-red">*</span></label> <div class="text-left"> <form id="formQuestions"> <br> <input type="text" value="' + data.formId + '" name="formId" hidden>'
                    var formulario = ""

                    for (var i = 0; i < data.questions.length; i++) {

                        htmlConfronta += '<div class="form-group padding-form"> <h6 class="questions-form" >' + data.questions[i].question + '</h6> ';

                        formulario += htmlConfronta

                        for (var d = 0; d < data.questions[i].options.length; d++) {
                            htmlConfronta += '<div class="custom-control custom-radio"> <input class="custom-control-input" type="radio" required value="' + data.questions[i].options[d].optionId + '" id="confrontaRadio' + i + '' + d + '" name="' + data.questions[i].question_id + '"> <label for="confrontaRadio' + i + '' + d + '" class="custom-control-label options-form">' + data.questions[i].options[d].option + '</label>  </div>'

                        }
                        htmlConfronta += '</div>';
                    }

                    htmlConfronta += '</form> </div>';
                    formulario = htmlConfronta
                    $('#confrontaForm').show();
                    $('#response').html(formulario);
                } else {

                    var htmlConfrontaResponse = "";
                    htmlConfrontaResponse = '<div class="error-page mt-0" style=" width: auto; "> <h2 class="headline text-warning title-modal-error" style=" float: none; "> Oops!</h2> <div class="error-content" style=" margin-left: 0px; "> <h3 class="content-title-modal-error"><i class="fas fa-exclamation-triangle text-warning"></i> Has excedido el máximo de intentos posibles.</h3> <p class="content-text-modal-error"> Por favor inténtalo nuevamente mañana '
                    if ($('#login').val() == 1) {

                        htmlConfrontaResponse += '<a href="/Administrator/dashboard">Volver a la Pagina principal</a></p> </div> <!-- /.error-content --> </div>'
                    } else {
                        htmlConfrontaResponse += '<a href="/">Volver a la Pagina principal</a></p> </div> <!-- /.error-content --> </div>'
                    }
                    $('#response').html(htmlConfrontaResponse);

                }

            });
            $('#confrontaCustomer').modal('show')
        }

    });


    $("#confrontaForm").click(function () {


        var headers = { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') };

        if ($("#formQuestions").serializeArray().length < 6) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
            });
            Toast.fire({
                type: 'error',
                title: 'Todos los campos son requeridos.'
            })
        } else {
            $.ajax({
                url: '/confrontInHouse',
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { questions: $("#formQuestions").serializeArray() },
                success: function (response) {
                    var htmlConfrontaResponse = '<div class="row justify-content-center">';

                    if (response < 4) {
                        htmlConfrontaResponse += '<div class="register-left" style="max-width: 290px;"> <img src="https://image.flaticon.com/icons/svg/753/753345.svg" alt="" style=" width: 13%; margin-top: 10%; margin-right: 3%; " /> <span class="text-secondary" style=" font-size: 20px; "> Formulario Incorrecto </span> </div><div class="col-12"> <label for="" style="font-size: 15px;">Debe volver a verificar la información <span class="color-red">*</span></label>'
                        $('#updateDataFailed').show();
                        $('#updateData').show();

                    } else {
                        htmlConfrontaResponse += '<div class="register-left" style="max-width: 290px;"> <img src="https://image.flaticon.com/icons/svg/845/845646.svg" alt="" style=" width: 13%; margin-top: 10%; margin-right: 3%; " /> <span class="text-secondary" style=" font-size: 20px; "> Formulario Exitoso </span> </div><div class="col-12"> <label for="" style="font-size: 15px;">Ya puede actualizar sus datos <span class="color-red">*</span></label> '
                        $('#updateData').show();
                    }
                    htmlConfrontaResponse += '  </div> </div>'
                    $('#response').html(htmlConfrontaResponse);

                }
            });

            onTimesUp();
            $('#confrontaForm').hide();
            var htmlConfronta = '<div class="spinner-border text-primary" role="status"> <span class="sr-only">Loading...</span> </div> <br> <span>Cargando...</span>';
            $('#response').html(htmlConfronta);
        }
    });

    $("#updateData").click(function () {


        var headers = { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') };


        $.ajax({
            url: '/change-customer-data/' + $('#CEDULA').val(),
            type: 'PUT',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: { customerData: $("#customerData").serializeArray() },
            success: function (response) {

                $('#updateData').hide();
                var htmlConfronta = '<div class="row justify-content-center"> <div class="register-left mb-2" style="max-width: 3000px;"> <div class="row"> <div class="col-12"> <img src="https://image.flaticon.com/icons/svg/845/845646.svg" alt="" style=" width: 45px; margin-top: 0%; margin-bottom: 1%; margin-right: 0%; " /> </div> <div class="col-12"> <span class="text-secondary">Los datos fueron actualizados correctamente</span> </div> </div> </div> <div class="col-12">';
                if ($('#login').val() == 1) {
                    htmlConfronta += '<a href="/Administrator/dashboard" class="btn btn-secondary text-white">Regresar</a> </div> </div>'
                } else {
                    htmlConfronta += '<a href="/" class="btn btn-secondary text-white">Regresar</a> </div> </div>'
                }
                $('#response').html(htmlConfronta);
            }
        });

        onTimesUp();
        $('#confrontaForm').hide();
        var htmlConfronta = '<div class="spinner-border text-primary" role="status"> <span class="sr-only">Loading...</span> </div> <br> <span>Cargando...</span>';
        $('#response').html(htmlConfronta);


    });

    const FULL_DASH_ARRAY = 283;
    const WARNING_THRESHOLD = 30;
    const ALERT_THRESHOLD = 15;

    const COLOR_CODES = {
        info: {
            color: "green"
        },
        warning: {
            color: "orange",
            threshold: WARNING_THRESHOLD
        },
        alert: {
            color: "red",
            threshold: ALERT_THRESHOLD
        }
    };

    const TIME_LIMIT = 120;
    let timePassed = 0;
    let timeLeft = TIME_LIMIT;
    let timerInterval = null;
    let remainingPathColor = COLOR_CODES.info.color;

    document.getElementById("timer").innerHTML = `
<div class="base-timer">
  <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
    <g class="base-timer__circle">
      <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
      <path
        id="base-timer-path-remaining"
        stroke-dasharray="283"
        class="base-timer__path-remaining ${remainingPathColor}"
        d="
          M 50, 50
          m -45, 0
          a 45,45 0 1,0 90,0
          a 45,45 0 1,0 -90,0
        "
      ></path>
    </g>
  </svg>
  <span id="base-timer-label" class="base-timer__label">${formatTime(
        timeLeft
    )}</span>
</div>
`;


    function onTimesUp() {
        clearInterval(timerInterval);
    }

    function startTimer() {
        timerInterval = setInterval(() => {
            timePassed = timePassed += 1;
            timeLeft = TIME_LIMIT - timePassed;
            document.getElementById("base-timer-label").innerHTML = formatTime(
                timeLeft
            );
            setCircleDasharray();
            setRemainingPathColor(timeLeft);

            if (timeLeft === 0) {
                onTimesUp();
                $('#confrontaForm').hide();
                var htmlConfronta = '<div class="row justify-content-center"><div class="register-left" style="max-width: 290px;"> <img src="https://image.flaticon.com/icons/svg/1636/1636066.svg" alt="" style=" width: 20%; margin-top: 10%; margin-right: 3%; " />  <span class="text-secondary">Oops! el formulario a expirado</span>  </div><div class="col-12"> <a href="javascript:location.reload()" class="btn btn-secondary text-white">Recargar</a> </div> </div>';
                $('#response').html(htmlConfronta);
            }
        }, 1000);
    }

    function formatTime(time) {
        const minutes = Math.floor(time / 60);
        let seconds = time % 60;

        if (seconds < 10) {
            seconds = `0${seconds}`;
        }

        return `${minutes}:${seconds}`;
    }

    function setRemainingPathColor(timeLeft) {
        const { alert, warning, info } = COLOR_CODES;
        if (timeLeft <= alert.threshold) {
            document
                .getElementById("base-timer-path-remaining")
                .classList.remove(warning.color);
            document
                .getElementById("base-timer-path-remaining")
                .classList.add(alert.color);
        } else if (timeLeft <= warning.threshold) {
            document
                .getElementById("base-timer-path-remaining")
                .classList.remove(info.color);
            document
                .getElementById("base-timer-path-remaining")
                .classList.add(warning.color);
        }
    }

    function calculateTimeFraction() {
        const rawTimeFraction = timeLeft / TIME_LIMIT;
        return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
    }

    function setCircleDasharray() {
        const circleDasharray = `${(
            calculateTimeFraction() * FULL_DASH_ARRAY
        ).toFixed(0)} 283`;
        document
            .getElementById("base-timer-path-remaining")
            .setAttribute("stroke-dasharray", circleDasharray);
    }

});
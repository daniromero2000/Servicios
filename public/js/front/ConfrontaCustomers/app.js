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
                var htmlConfronta = '<div class="row justify-content-center"><div class="register-left" style="max-width: 290px;"> <img src="https://image.flaticon.com/icons/svg/1636/1636066.svg" alt="" style=" width: 20%; margin-top: 10%; margin-right: 3%; " />  <span class="text-secondary">Oops! el formulario a expirado</span>  </div><div class="col-12"> <a href="javascript:location.reload()" class="btn btn-secondary text-white">Recargar</a> </div> </div>';
                $('#response').html(htmlConfronta);
            }, 120000);
            startTimer();

            console.log(data.questions)
            var htmlConfronta = '<label for="">Este formulario tiene un tiempo máximo de 2 minutos para ser diligenciado <span class="color-red">*</span></label> <div class="text-left"> <form id="formQuestions"> <br> <input type="text" value="' + data.formId + '" name="formId" hidden>'
            var formulario = ""

            for (var i = 0; i < data.questions.length; i++) {
                console.log(data.questions[i].options.length)
                htmlConfronta += '<div class="form-group pl-4 pr-4"> <h6 >' + data.questions[i].question + '</h6> ';


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
            data: { questions: $("#formQuestions").serializeArray() },
            success: function (response) {
                console.log(response);
            }
        });

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
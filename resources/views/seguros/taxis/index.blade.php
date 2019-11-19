<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>SOAT</title>
    <link rel="stylesheet" href="{{ asset('css/seguros/taxis/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/seguros/taxis/main.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c1313463c5.js" crossorigin="anonymous"></script>
</head>


<body>
    <nav class="navbar  reset-baner reset-nav navbar-light bg-white">
        <div class="row w-100 d-flex align-items-center text-center row-reset">

            <div style="margin-left: auto;margin-right: auto;"
                class="col-12 col-sm-4 col-md-3 col-lg-2 col-xl-5 col-reset">
                <a class="nav-link logo-baner"> <img
                        src="{{ asset('images/assets/logo.png') }}" class=" img-fluid" alt=""> <span
                        class="sr-only">(current)</span></a>
            </div>
            <div style="margin-left: auto;margin-right: auto;"
                class="col-12 col-sm-5 col-md-6 col-lg-6 col-xl-7 mt-2 text-left col-reset">
                <p class="title-inicial">¡Lleva tu SOAT a crédito!</p>
            </div>


        </div>
        <div class="row w-100 d-flex align-items-center text-center row-reset">
            <img src="{{ asset('images/assets/baner.png') }}" class="img-fluid img-baner" alt="">
        </div>
    </nav>

    <div>
        <div class=" row-reset row contenedor">

            <div class="col-12 col-sm-12 col-lg-12 col-xl-12 col-reset ">
                <img src="{{ asset('images/assets/Fondo.png') }} " class="img-reset" style="width:100%;" alt="">
            </div>
            <div class="imgFon col-12 col-sm-12 col-md-8 col-lg-5 col-xl-5  mb-2 ">
                <div class="container text-center">
                    <span class="title-inicial2">¡Llévalo a crédito!</span>
                    <h2 class="title-inicial3 mb-5"> con cómodas cuotas</h2>
                </div>

                <div class="col-12 col-sm-9 col-md-11 col-lg-11 col-xl-11 text-center" style="margin: auto;">
                    <a href="#" class="btn boton-submit btn-primary py-3 shadow-lg w-75 px-3" data-toggle="modal"
                        data-target="#modalAppointment" style="border-radius: 40px;">Quiero mi soat a crédito</a>
                </div>

                <div class="col-8 col-sm-6 col-md-7 col-lg-7 col-xl-7 text-center mt-5  " style="margin: auto;">
                    <a href="https://api.whatsapp.com/send?phone=573138701355&text=Quiero más información, sobre el crédito fácil de libranza"
                        target="_blank"><img class="img-fluid boton-wp" src="{{ asset('images/assets/botonWP.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>





    <!-- hasta aqui -->

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/seguros/taxis/bootstrap.min.js') }}"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
    // 1. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // 2. This function creates an <iframe> (and YouTube player)
    //    after the API code downloads.
    var player;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            height: '100%',
            width: '100%',
            playerVars: {
                loop: 1,
                controls: 1,
                showinfo: 1,
                autohide: 1,
                modestbranding: 1,
                autoplay: 0,
                vq: 'hd720'
            },
            videoId: 'QQdp5gF7LAw',
            events: {
                'onStateChange': onPlayerStateChange
            }
        });
    }

    // 3. The API will call this function when the video player is ready.
    function onPlayerReady(event) {
        event.target.playVideo();
    }

    var done = false;

    function onPlayerStateChange(event) {

    }

    function stopVideo() {
        player.stopVideo();
    }
    /*
    setTimeout(function(){
    	$('#modalAgradacimiento').modal('show');
    }, 30000);
    setTimeout(function(){
    	$('#modalAgradacimiento').modal('hide');
    }, 48000);
    */
</script>

</html>
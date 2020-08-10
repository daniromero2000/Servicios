
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/customertype/customertype.css') }}">
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>

<title>Información de Créditos</title>

<script type="text/javascript">
   function FormSubmit(i) {
      let cedula1 = document.getElementsByName("identificationNumber")[0].value;

      switch (i) {
         case 1:
            document.forms["formulario"].action = "wscartera";
            localStorage.setItem("cedula1", cedula1);
            break;
         case 2:
            document.forms["formulario"].action = "obligations";
            document.getElementsByName("identificationNumber")[0].value = localStorage.getItem("cedula1", cedula1);
            break;
         case 3:
            document.forms["formulario"].action = "currentcredits";
            document.getElementsByName("identificationNumber")[0].value = localStorage.getItem("cedula1", cedula1);
            break;
         case 4:
            document.forms["formulario"].action = "expiredcredits";
            document.getElementsByName("identificationNumber")[0].value = localStorage.getItem("cedula1", cedula1);
            break;
         case 5:
            document.forms["formulario"].action = "paymenttime";
            document.getElementsByName("identificationNumber")[0].value = localStorage.getItem("cedula1", cedula1);
            break;
         case 6:
            document.forms["formulario"].action = "customertype";
            document.getElementsByName("identificationNumber")[0].value = localStorage.getItem("cedula1", cedula1);
            break;
         case 7:
            document.forms["formulario"].action = "summary";
            document.getElementsByName("identificationNumber")[0].value = localStorage.getItem("cedula1", cedula1);
            break;
      }
      document.forms["formulario"].submit();
   }
</script>

<hr>
<div class="row">
   <div class="col-md-5">
      <h3 style="margin-left: 1cm;">Información Créditos</h3>
   </div>
   <div class="col-md-5">
      @yield('cliente')
   </div>
</div>

<hr>

<form name="formulario" id="formulario" method="get" action="">
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
         <input type="text" style="width : 200px" name="identificationNumber" class="form-control mr-sm-2" placeholder="Digite la Cedula" aria-label="Search" required>

         <input type="button" class="btn btn-primary" class="btn btn-outline-secondary" id="wscartera" value="ConsultarWS" name="consultar" onclick="JavaScript:FormSubmit(1);" />
         <input type="button" class="btn btn-dark" id="obligaciones" value="Obligaciones" name="obligaciones" onclick="JavaScript:FormSubmit(2);" />
         <input type="button" class="btn btn-dark" id="vigentes" value="Creditos Al Dia" name="vigentes" onclick="JavaScript:FormSubmit(3);" />
         <input type="button" class="btn btn-dark" id="vencidos" value="Vencimientos" name="vencido" onclick="JavaScript:FormSubmit(4);" />
         <input type="button" class="btn btn-dark" id="tipo" value="Pagos" name="pagos" onclick="JavaScript:FormSubmit(5);" />
         <input type="button" class="btn btn-dark" id="pagos" value="Tipo Cliente" name="tipo" onclick="JavaScript:FormSubmit(6);" />
         <input type="button" class="btn btn-dark" id="resumen" value="Resumen" name="resumen" onclick="JavaScript:FormSubmit(7);" />
      </div>
   </nav>
</form>

<hr>
@yield('content')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
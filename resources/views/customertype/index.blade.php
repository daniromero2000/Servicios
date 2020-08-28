@extends('layouts.admin.app')

@section('content')

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/customertype/customertype.css') }}">
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>

<title>Información de Créditos</title>

<script type="text/javascript">
   function FormSubmit() {
      document.forms["formulario"].action = "wscartera";
      document.forms["formulario"].submit();
   }
</script>

<hr>
<div class="row">
   <div class="col-md-5">
      <h3 style="margin-left: 1cm;"><i class="fas fa-poll-h" aria-hidden="true"></i> Información Créditos</h3>
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
         <input type="button" class="btn btn-primary" class="btn btn-outline-secondary" id="wscartera" value="ConsultarWS" name="consultar" onclick="JavaScript:FormSubmit();" />
      </div>
   </nav>
</form>

<hr>

@stop
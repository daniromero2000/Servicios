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

<br>
<div class="col-md-12">
   <h3 style= "text-align:center"><i class="fas fa-poll-h"></i> Información Créditos</h3>
</div>

<div class="row">
   <div class="col col-lg-4"></div>
      <div class="card" style="margin-left: 1.7cm">
        <div class="shadow p-3 mb-0 bg-white rounded text-black">
         <div class="card-body">
            <form name="formulario" id="formulario" method="get" action="">
                <label style="margin-left: 0.2cm">Número de identificación</label>
                <input style="margin-left: 0.2cm" type="text" name="identificationNumber" class="form-control ng-pristine ng-empty ng-invalid ng-invalid-required ng-touched" required>
                <br>  
                <button style="margin-left: 2cm" type="submit" class="btn btn-primary" class="btn-sm-reset" class="btn btn-outline-secondary" id="wscartera" value="Buscar" name="consultar" onclick="JavaScript:FormSubmit();">
                <i class="fa fa-search"> </i>
                Buscar
                </button>                
            </form>
          </div>
        </div>  
    </div>
   <div class="col col-lg-5"></div>
</div>
@stop
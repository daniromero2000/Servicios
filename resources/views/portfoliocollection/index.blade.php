@extends('layouts.admin.app')
@section('linkStyleSheets')
<link rel="stylesheet"
  href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">

@endsection
@section('content')

 <div class="form-group row">
    <div class="col-8">
        <h2>Recibos de Caja<h2>
    </div>        
 </div>

 <div class="form-group row">
    <label for="ID-text" class="col-2 col-form-label">ID</label>
    <div class="col-8">
      <input class="form-control" type="text" id="id-payments">
    </div>
  </div>
  <div class="form-group row">
    <label for="identification-input" class="col-2 col-form-label">Identificación</label>
    <div class="col-8">
      <input class="form-control" type="text" id="identification-payments">
    </div>
  </div>
  <div class="form-group row">
    <label for="name-input" class="col-2 col-form-label">Nombre Cliente</label>
    <div class="col-8">
      <input class="form-control" type="text" id="customer-payments">
    </div>
  </div>
  <div class="form-group row">
    <label for="amount-input" class="col-2 col-form-label">Valor a Pagar</label>
    <div class="col-8">
      <input class="form-control" type="number" id="amount-payments">
    </div>
  </div>
  <div class="form-group row">
    <label for="date-input" class="col-2 col-form-label">Fecha Recibo</label>
    <div class="col-8">
      <input class="form-control" type="datetime-local" id="date-payments">
    </div>
  </div>
  <div class="form-group">
    <label for="Textarea">Observaciones</label>
    <textarea class="form-control" id="notes-input" rows="3"></textarea>
  </div>
  <div class="form-group row">
    <label for="user-input" class="col-2 col-form-label">User</label>
    <div class="col-8">
      <input class="form-control" type="number" id="user-payments">
    </div>
  </div>
  @endsection

  
  
  

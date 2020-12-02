@extends('layouts.admin.app')
@section('linkStyleSheets')
<link rel="stylesheet" href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
<link rel="stylesheet" href="{{ asset('css/portfoliocollection/payments.css') }}">

@endsection
@section('content')

<form action="/portfolioCollections" method="POST">
  @csrf
<div class="container container-payments">
  <div class="form-group row">
    <div class="col-8 title-payments">
        <h2>Recibos de Caja<h2>
    </div>        
  </div>
  <div class="form-group row">
    <label for="ID-text" class="col-2 col-form-label">ID</label>
    <div class="col-4">
      <input class="form-control" type="text" id="id-payments">
    </div>
  </div>
  <div class="form-group row">
    <label for="identification-input" class="col-2 col-form-label">Identificación</label>
    <div class="col-4">
      <input class="form-control" name="identification" type="text" id="identification-payments">
    </div>
  </div>
  <div class="form-group row">
    <label for="name-input" class="col-2 col-form-label">Nombre Cliente</label>
    <div class="col-4">
      <input class="form-control" name="customer" type="text" id="customer-payments">
    </div>
  </div>
  <div class="form-group row">
    <label for="reference-input" class="col-2 col-form-label">No. Credito</label>
    <div class="col-4">
      <input class="form-control" name="reference" type="text" id="reference-payments">
    </div>
  </div>
  <div class="form-group row">
    <label for="amount-input" class="col-2 col-form-label">Valor a Pagar</label>
    <div class="col-4">
      <input class="form-control" name="amount" type="number" id="amount-payments">
    </div>
  </div>
  <div class="form-group row">
    <label for="date-input" class="col-2 col-form-label">Fecha Recibo</label>
    <div class="col-4">
      <input class="form-control" name="date-payment" value="{{ date("Y-m-d h:s:m") }}" type="datetime" id="date-payments" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="area-input" class="col-2 col-form-label">Observaciones</label>
    <div class="col-4">
      <textarea class="form-control" name="note" id="notes-input" rows="3"></textarea>
    </div> 
  </div>
  <div class="form-group row">
    <label for="user-input" class="col-2 col-form-label">User</label>
    <div class="col-2">
      <input class="form-control" name="user" type="number" id="user-payments">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
  </div>
</div>
</form>

@endsection

  
  
  

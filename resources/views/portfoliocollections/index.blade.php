@extends('layouts.admin.app')
@section('linkStyleSheets')
    <link rel="stylesheet"
        href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
    <link rel="stylesheet" href="{{ asset('css/portfoliocollection/payments.css') }}">
@endsection
@section('content')
    <form action="/Administrator/portfolioCollections" method="POST">
        @csrf
        <div class="container-payments shadow mt-4">
         <div class="p-4">
              <div class="form-group row">
                <div class="col-12 ">
                    <h2>Recibos de Caja<h2>
                </div>
            </div>
            <div class="form-group row">
                <label for="identification-input" class="col-3 col-form-label">Identificación</label>
                <div class="col-9">
                    <input class="form-control" name="identification" type="text" id="identification-payments">
                </div>
            </div>
            <div class="form-group row">
                <label for="name-input" class="col-3 col-form-label">Nombre Cliente</label>
                <div class="col-9">
                    <input class="form-control" name="customer" type="text" id="customer-payments">
                </div>
            </div>
            <div class="form-group row">
                <label for="reference-input" class="col-3 col-form-label">No. Credito</label>
                <div class="col-9">
                    <input class="form-control" name="reference" type="text" id="reference-payments">
                </div>
            </div>
            <div class="form-group row">
                <label for="amount-input" class="col-3 col-form-label">Valor a Pagar</label>
                <div class="col-9">
                    <input class="form-control" name="amount" type="number" id="amount-payments">
                </div>
            </div>
            <div class="form-group row">
                <label for="date-input" class="col-3 col-form-label">Fecha Recibo</label>
                <div class="col-9">
                    <input class="form-control" name="date-payment" value="{{ date('d/m/Y') }}" type="datetime"
                        id="date-payments" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="area-input" class=" col-form-label">Observaciones</label>
                <div class="col-9">
                    <textarea class="form-control" name="note" id="notes-input" rows="4"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12 d-flex mt-4">
                    <button type="submit" class="btn btn-primary ml-auto">Guardar</button>
                </div>
            </div>
         </div>
        </div>
    </form>

@endsection

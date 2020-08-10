@extends('layouts.admin.app')

@section('content')
@include('customertype.layout')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card border-light">
          <div class="card bg-secondary text-white">
            <div class="card-body">
              <h4 class="card-title">Creditos Vencidos</h4>

              <table class="table table-responsive table-striped">
                <thead>
                  <tr>
                    <th style="width:250px">No. Credito</th>
                    <th style="width:250px">Cuotas Mora</th>
                    <th style="width:250px">Tiempo Mora</th>
                    <th style="width:250px">Valor Vencido</th>
                  </tr>
                </thead>
                <tbody>

                  @if($expired->count())
                  @foreach($expired as $currents)
                  <tr>
                    <td>{{ $currents->credit }}</td>
                    <td>{{ $currents->expired_payment }}</td>
                    <td>{{ $currents->expired_time }}</td>
                    <td>{{ number_format($currents->expired_amount) }}</td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="4">No hay registros !!</td>
                  </tr>
                  @endif
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
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
              <h4 class="card-title">Historia de Pagos > 90 días</h4>

              <table class="table table-responsive table-striped">
                <thead>
                  <tr>
                    <th style="width:200px">No. Credito</th>
                    <th style="width:200px">Cuota</th>
                    <th style="width:200px">Fecha Cuota</th>
                    <th style="width:200px">Fecha Pago</th>
                    <th style="width:200px">Tiempo Mora</th>
                  </tr>
                </thead>
                <tbody>

                  @if($payment->count())
                  @foreach($payment as $payments)
                  <tr>
                    <td>{{ $payments->credit }}</td>
                    <td>{{ $payments->period }}</td>
                    <td>{{ $payments->payment_fee }}</td>
                    <td>{{ $payments->payment_date }}</td>
                    <td>{{ $payments->expired_time }}</td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="5">No hay registros !!</td>
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
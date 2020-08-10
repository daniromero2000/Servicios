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
              <h4 class="card-title">Creditos Al Dia</h4>

              <table class="table table-responsive table-striped">
                <thead>
                  <tr>
                    <th style="width:250px">No. Credito</th>
                    <th style="width:250px">Cuotas Por Vencer</th>
                    <th style="width:250px">Cuotas Pagadas</th>
                    <th style="width:250px">Valor Pendiente</th>
                  </tr>
                </thead>
                <tbody>

                  @if($current->count())
                  @foreach($current as $currents)
                  <tr>
                    <td>{{ $currents->credit }}</td>
                    <td>{{ $currents->unpaid_fees }}</td>
                    <td>{{ $currents->paid_fees }}</td>
                    <td>{{ number_format($currents->current_amount) }}</td>
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
@extends('layouts.admin.app')

@section('content')

<style type="text/css">
  #buscarws{
    text-align: right; 
  }

  #formws{
    display: inline-block; 
    vertical-align: middle; 
    line-height: 14px; 
    margin-right: 3cm;
  }  
</style> 

<div id="buscarws">
  <form name="formws" id="formws" class="form-inline" method="get" action = /Administrator/wscartera>
    <input class="form-control sm-2" name="identificationNumber" type="text" placeholder="Nueva Búsqueda" aria-label="Search">
    <button class="btn btn-primary" class="btn-sm-reset" class="btn aqua-gradient btn-rounded btn-sm my-0" type="submit">
      <i class="fa fa-search"></i>
       Buscar</button>
  </form>
</div>
<br>
  
  {{-- Obligaciones  --}}

<div class="col-md-11">
  <div class="card" style="margin-left:1cm">
    <div class="shadow p-3 mb-0 bg-white rounded text-black">
      <div class="card-body">
          <table class="table table-responsive" id="mi-tabla" style="margin-left: 0.5cm">
            <thead>
              <tr>
                <th style="width:180px">Crédito</th>
                <th style="width:200px">Fecha</th>
                <th style="width:80px">Monto</th>
                <th style="width:50px">Cuota</th>
                <th style="width:30px; text-align:center">Plazo</th>
                <th style="width:10px; text-align:center">Castigo</th>
                <th style="width:40px; text-align:center">Estado</th>
                <th style="width:230px">Sucursal</th>
                <th style="width:400px">Línea</th>
              </tr>
            </thead>
            <tbody>
              @if($obligation->count())
              @foreach($obligation as $obligaciones)

              <tr>
                <td style="font-size:75%;">{{ $obligaciones->credit }}</td>
                <td style="font-size:75%;">{{ $obligaciones->legaldate }}</td>
                <td style="font-size:80%;">{{ number_format($obligaciones->amount) }}</td>
                <td style="font-size:80%;">{{ number_format($obligaciones->fee) }}</td>
                <td style="font-size:80%; text-align:center">{{ $obligaciones->term }}</td>
                <td style="font-size:80%; text-align:center">{{ $obligaciones->punished }}</td>
                <td style="font-size:75%; text-align:center">{{ $obligaciones->state }}</td>
                <td style="font-size:75%;">{{ $obligaciones->subsidiary }}</td>
                <td style="font-size:75%;">{{ $obligaciones->line }}</td>
              </tr>
              @endforeach

                <h5 id="nombre"><span class="label label-success"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp; {{ $obligaciones->name }}&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;&nbsp; {{ $obligaciones->identificationNumber }} </span><h5>
                 
                  @else

                  <tr>
                    <td colspan="9" style="text-align:center">No hay registros !!</td>
                  </tr>
                  @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

{{--  Creditos al Dia  --}}

<div class="col-md-11">
  <div class="card" style="margin-left:1cm">
      <div class="shadow p-3 mb-0 bg-white rounded text-black">
        <div class="card-body">
          <h4 class="card-title"><i class="fas fa-poll-h" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Créditos Al Día</h4>

          <table class="table table-responsive" style="margin-left: 0.5cm">

            <thead>
              <tr>
                <th style="width:250px">No. Crédito</th>
                <th style="width:250px; text-align:center">Cuotas Por Vencer</th>
                <th style="width:250px; text-align:center">Cuotas Pagadas</th>
                <th style="width:250px; text-align:center">Valor Pendiente</th>
              </tr>
            </thead>
            <tbody>

              @if($currentcredit->count())
              @foreach($currentcredit as $currents)
              <tr>
                <td style="font-size:85%">{{ $currents->credit }}</td>
                <td style="font-size:85%; text-align:center">{{ $currents->unpaid_fees }}</td>
                <td style="font-size:85%; text-align:center">{{ $currents->paid_fees }}</td>
                <td style="font-size:85%; text-align:center">{{ number_format($currents->current_amount) }}</td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="4" style="text-align:center">No hay registros !!</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>      
</div>

{{--  Vencimientos  --}}

<div class="col-md-11">
  <div class="card" style="margin-left:1cm">
      <div class="shadow p-3 mb-0 bg-white rounded text-black">
        <div class="card-body">
          <h4 class="card-title"><i class="fas fa-poll-h" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Créditos Vencidos</h4>

          <table class="table table-responsive" style="margin-left: 0.5cm">
            <thead>
              <tr>
                <th style="width:250px">No. Crédito</th>
                <th style="width:250px; text-align:center">Cuotas Mora</th>
                <th style="width:250px; text-align:center ">Tiempo Mora</th>
                <th style="width:250px; text-align:center">Valor Vencido</th>
              </tr>
            </thead>
            <tbody>

              @if($expiredcredit->count())
              @foreach($expiredcredit as $expired)
              <tr>
                <td style="font-size:85%;">{{ $expired->credit }}</td>
                <td style="font-size:85%; text-align:center">{{ $expired->expired_payment }}</td>
                <td style="font-size:85%; text-align:center">{{ $expired->expired_time }}</td>
                <td style="font-size:85%; text-align:center">{{ number_format($expired->expired_amount) }}</td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="4" style="text-align:center">No hay registros !!</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div> 
   </div>
</div>

{{--  Pagos > 90 dias  --}}

<div class="col-md-11">
  <div class="card" style="margin-left:1cm">
      <div class="shadow p-3 mb-0 bg-white rounded text-black">
        <div class="card-body">
          <h4 class="card-title"><i class="fas fa-poll-h" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Historia de Pagos > 90 días</h4>

          <table class="table table-responsive" style="margin-left: 0.5cm">
            <thead>
              <tr>
                <th style="width:200px">No. Crédito</th>
                <th style="width:200px; text-align:center">Cuota</th>
                <th style="width:200px; text-align:center">Fecha Cuota</th>
                <th style="width:200px; text-align:center">Fecha Pago</th>
                <th style="width:200px; text-align:center">Tiempo Mora</th>
              </tr>
            </thead>
            <tbody>

              @if($payment->count())
              @foreach($payment as $payments)
              <tr>
                <td style="font-size:85%;">{{ $payments->credit }}</td>
                <td style="font-size:85%; text-align:center">{{ $payments->period }}</td>
                <td style="font-size:85%; text-align:center">{{ $payments->payment_fee }}</td>
                <td style="font-size:85%; text-align:center">{{ $payments->payment_date }}</td>
                <td style="font-size:85%; text-align:center">{{ $payments->expired_time }}</td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="5" style="text-align:center">No hay registros !!</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
     </div>
  </div>
</div>

{{--  Tipo Cliente  --}}

<div class="col-md-11">
  <div class="card" style="margin-left:1cm">
      <div class="shadow p-3 mb-0 bg-white rounded text-black">
       <div class="card-body">
          <h4 class="card-title"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Tipo Cliente</h4>
          <table class="table table-responsive" style="margin-left: 0.5cm">
            <thead>
              <tr>
                <th style="width:1000px">Tipo Cliente</th>
              </tr>
            </thead>
            <tbody>

              @if($customertype->count())
              @foreach($customertype as $customers)
              <tr>
                <td style="text-align:center; font-size:85%">{{ $customers->type }}</td>
              </tr>
              @endforeach
              @else
              <tr>
                <td style="text-align:center">No hay registros !!</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
   </div>
</div>

{{--  Resumen  --}}

<div class="col-md-11">
  <div class="card" style="margin-left:1cm">
     <div class="shadow p-3 mb-0 bg-white rounded text-black">
       <div class="card-body">
          <h4 class="card-title"><i class="fas fa-poll-h" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Resumen Créditos</h4>

          <table class="table table-responsive" style="margin-left: 0.5cm">
            <thead>
              <tr>
                <th style="width:250px">Créditos Vencidos</th>
                <th style="width:250px; text-align:center">Créditos Al Día</th>
                <th style="width:250px; text-align:center">Sumatoria Cuotas</th>
                <th style="width:250px; text-align:center">Sumatoria Saldos</th>
              </tr>
            </thead>
            <tbody>
              @if($summary->count())
              @foreach($summary as $summary)
              <tr>
                <td style="font-size:85%">{{ number_format($summary->expired_credits) }}</td>
                <td style="text-align:center; font-size:85%">{{ number_format($summary->current_credits) }}</td>
                <td style="text-align:center; font-size:85%">{{ number_format($summary->summary_fees) }}</td>
                <td style="text-align:center; font-size:85%">{{ number_format($summary->summary_amount) }}</td>
              </tr>
              @endforeach

              @else
              <tr>
                <td colspan="4" style="text-align:center">No hay registros !!</td>
              </tr>
              @endif

            </tbody>
          </table>

        </div>
      </div> 
   </div>
</div>
@endsection
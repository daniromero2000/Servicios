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
     
              <h4 class="card-title">Creditos</h4>

              <table class="table table-responsive table-striped" id="mi-tabla">
                <thead>
                  <tr>
                    <th style="width:150px">Credito</th>
                    <th style="width:110px">Fecha</th>
                    <th style="width:80px">Monto</th>
                    <th style="width:50px">Cuota</th>
                    <th style="width:30px">Plazo</th>
                    <th style="width:10px">Castigo</th>
                    <th style="width:40px">Estado</th>
                    <th style="width:230px">Sucursal</th>
                    <th style="width:520px">Linea</th>
                  </tr>
                </thead>
                <tbody>
                  @if($obligations->count())

                  @foreach($obligations as $obligaciones)

                  <tr>
                    <td style="font-size:85%;">{{ $obligaciones->credit }}</td>
                    <td style="font-size:85%;">{{ $obligaciones->legaldate }}</td>
                    <td style="font-size:85%;">{{ number_format($obligaciones->amount) }}</td>
                    <td style="font-size:85%;">{{ number_format($obligaciones->fee) }}</td>
                    <td style="font-size:85%;">{{ $obligaciones->term }}</td>
                    <td style="font-size:85%;">{{ $obligaciones->punished }}</td>
                    <td style="font-size:85%;">{{ $obligaciones->state }}</td>
                    <td style="font-size:85%;">{{ $obligaciones->subsidiary }}</td>
                    <td style="font-size:85%;">{{ $obligaciones->line }}</td>
                  </tr>
                  @endforeach

                  @section('cliente')
                  <h5 id="nombre"><span class="label label-success"> {{ $obligaciones->name }} </span>
                    <h5>
                      @endsection

                      @else

                      <tr>
                        <td colspan="9">No hay registros !!</td>
                      </tr>
                      @endif

                      {{ $obligations->links() }}

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
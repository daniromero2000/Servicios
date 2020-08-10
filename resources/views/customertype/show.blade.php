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
              <h4 class="card-title">Tipo de Cliente</h4>

              <table class="table table-responsive table-striped">
                <thead>
                  <tr>
                    <th style="width:1000px">Tipo Cliente</th>
                  </tr>
                </thead>
                <tbody>

                  @if($customer->count())
                  @foreach($customer as $customers)
                  <tr>
                    <td>{{ $customers->type }}</td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="1">No hay registros !!</td>
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
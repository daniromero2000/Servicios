@extends('layouts.admin.app')

@section('content')
@include('customertype.layout')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card border-light">
          <div class="card bg-secondary bg-gradient text-white">
            <div class="card-body">
              <h4 class="card-title">Resultado Consulta</h4>
              <table class="table table-responsive table-striped">
                <thead>
                  <tr>
                    <th style="width:1000px">Consulta Terminada !!</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@stop
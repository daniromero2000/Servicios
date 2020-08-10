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
             <h4 class="card-title">Resumen Creditos</h4>  
              
              <table class="table table-responsive table-striped">
              <thead>
               <tr>
                 <th style="width:250px">Creditos Vencidos</th>
                 <th style="width:250px">Creditos Al Dia</th>
                 <th style="width:250px">Sumatoria Cuotas</th>
                 <th style="width:250px">Sumatoria Saldos</th>
              </tr>
             </thead>
            <tbody>
            @if($summary->count())  
            @foreach($summary as $summary) 
            <tr>
              <td>{{ number_format($summary->expired_credits) }}</td>
              <td>{{ number_format($summary->current_credits) }}</td>
              <td>{{ number_format($summary->summary_fees) }}</td>
              <td>{{ number_format($summary->summary_amount) }}</td>
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
</div>

@stop
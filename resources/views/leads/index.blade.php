@extends('layouts.app')
 
@section('content')

    <div class="containerleads container">   
       
        <br>
        @if (Session::get('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
	<div class="row tituloLeads">
		<div class="col-12">
			<h3>Consulta de Leads </h3>
		</div>
	</div>
        <div class="table table-responsive">

            <table class="table table-hover table-striped leadTable">
                <thead class="headTableLeads" >
                    <tr>
                        
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Tel&eacutefono</th>
                        <th>Ciudad</th>
                        <th>Servicio</th>
                        <th>Producto</th>
                        <th>Fecha de creaci&oacuten</th>
                        
                        <th >M&aacutes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leadsQuery as $key => $lead)
                    <tr>
                        

                       
                        <td>{{ $lead->name }}</td>
                        <td>{{$lead->lastName}}</td>
                        <td>{{$lead->telephone}}</td>
                        <td>{{$lead->city}}</td>
                        <td>{{$lead->typeService}}</td>
			<td>{{$lead->typeProduct}}</td>
                        <td> {{$lead->created_at}}</td>
                        <td class="leadTableOptions" >

                            <div class="row rowAdjust">
                                <div class="col-12">
                                    @if ($lead->idLead != NULL)    
                                            <a href="" class="btn" data-toggle="modal" data-target="#leadModal@php echo $lead->id @endphp" ><i class="fa fa-eye"></i></a><br>
                                    @else
                                            
                                            <span> <i class="fas fa-eye-slash"></i> </span> 
                                    @endif
                                </div>
                              
                                
                            </div>      
                            
     
                            
                        </td>
                    </tr>

			<div class="modal fade hide" id="leadModal@php echo $lead->id @endphp" tabindex="-1" role="dialog" aria-hidden="true">

                                <div class="modal-dialog">
                                    
                                    <div class="modal-content">
                                        
                                        <div class="modal-header">
                                            <h4>Tarjeta Oportuya Gray</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
         					 <span aria-hidden="true">&times;</span>
       						 </button>
                                        </div>

                                        <div class="modal-body">
                                            
                                            <div class="row">
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Nombre</strong>
							<br>
                                                        {{ $lead->name }}
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Apellido</strong>
							<br>
                                                        {{ $lead->lastName }}
                                                    </div>
                                                </div>
					    </div>
					    <div class="row">					 
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Email</strong>
							<br>
                                                        {{ $lead->email }}
                                                    </div>
                                                </div>

                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>tel&eacutefono</strong>
							<br>
                                                        {{ $lead->telephone }}
                                                    </div>
                                                </div>
					    </div>
					    <div class="row">

                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <strong>Ciudad</strong>
							<br>
                                                        {{ $lead->city }}
                                                    </div>
                                                </div>
					    </div>
					    <div class="row">
	
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Servicio</strong>
							<br>
                                                        {{ $lead->typeService }}
                                                    </div>
                                                </div>

                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Producto</strong>
							<br>
                                                        {{ $lead->typeProduct }}
                                                    </div>
                                                </div>
					   </div>
					    <div class="row">


                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>L&iacutenea de Credito</strong>
							<br>
                                                        {{ $lead->creditLine }}
                                                    </div>
                                                </div>

                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Pagadur&iacutea</strong>
							<br>
                                                        {{ $lead->pagaduria }}
                                                    </div>
                                                </div>

					</div>
					    <div class="row">

                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Edad</strong>
							<br>
                                                        {{ $lead->age }}
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Tipo de cliente</strong>
							<br>
                                                        {{ $lead->customerType }}
                                                    </div>
                                                </div>
					</div>
					    <div class="row">

                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <strong>Salario</strong>
							<br>
                                                        {{ $lead->salary }}
                                                    </div>
                                                </div>


                                            </div>


                                        </div>

                                    </div>

                                </div>
                                
                            </div>
                    @endforeach
                </tbody>
            </table>
           
     {{$leadsQuery->links()}}
        </div>
    </div>
@stop
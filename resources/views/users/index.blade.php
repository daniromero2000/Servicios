@extends('layouts.app')
 
@section('content')

    <div class="containerUsers container">   
        <div class="row">
            <a href="{{ route('users.create') }}" class="buttonCreateUsers">Crear Usuario</a>
        </div>

        <br>
        @if (Session::get('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
        <div class="table table-responsive">

            <table class="table table-bordered table-hover table-striped userTable">
                <thead>
                    <tr>
                        
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Última modificación</th>                        
                        <th> Tipo Usuario</th>
                        <th >Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                    <tr>
                        
                        <td>{{ $user->name }}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->updated_at}}</td>
                        @if($user->idProfile == 1)
                            <td>Administrador</td>
                        @elseif($user->idProfile == 2)
                            <td>Líder Canal Dígital</td>
                        @else
                            <td>Community Manager</td>
                        @endif
                        

                        <td class="userTableOptions" >

                            <div class="row rowAdjust">
                                <div class="col-4">
                                       <a href="{{route('users.show',$user->id)}}" class="btn " ><i class="fa fa-eye"></i></a><br>            
                                </div>
                                <div class="col-4">
                                       <a href="{{route('users.edit',$user->id)}}" class="btn " ><i class="fas fa-pencil-alt"></i></i></a><br>            
                                </div>
                                <div class="col-4">
                                       <a href="#" class="btn"  data-toggle="modal" data-target="#userModal@php echo $user->id @endphp"><i class="fas fa-trash-alt"></i></a><br>           
                                </div>                             
                                
                            </div>      
                            
     
                            
                        </td>
                    </tr>
                    <div class="modal fade" id="userModal@php echo $user->id @endphp" tabindex="-1" role="dialog" aria-hidden="true">

                                <div class="modal-dialog">
                                    
                                    <div class="modal-content">
                                        
                                        <div class="modal-header">
                                            
                                        </div>

                                        <div class="modal-body">
                                            
                                            <div class="row">
                                                <p>¿Está seguro que desea eliminar el usuario?</p>
                                            </div>

                                             <form action="{{ route('users.destroy', $user->id) }}" method="POST" >
                                                @method('DELETE')
                                                @csrf 
                                                <button type="submit" class="btn btn-danger" value="Delete"> Elminar</button>                           
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                                
                            </div>
                    @endforeach
                </tbody>
            </table>
           
        {!! $users->links() !!}
        
        </div>
    </div>
@stop
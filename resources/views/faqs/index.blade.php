@extends('layouts.app')
 
@section('content')

<style>
    .card{
        margin: 10px;
    }

    .create {
        margin: auto;
    }

    .create button {
       
        margin: 10px 15px ;
    }
    .card-header{
        background: white;
    }
    .ulFAQ{
        padding: 0px;
        list-style: none;
        float: right;
        
    }
    .ulFAQ li{
        display: inline-block;
    }
    .col-faq{
        padding: 0px !important;
    }
    .col-sm-2 a {
        padding: 3px 6px;
    }
    .textareaReadOnly{
        background-color: white !important; 
    }
    
</style>


      
        <div class="row create">
            <button class="btn btn-primary" data-toggle="modal" data-target="#createModal"> Crear FAQs </button>
        </div>

        @if (Session::get('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
        
        @foreach($preguntas as $pregunta)
        <div class="card">
              <div class="card-header row">
                <div class="col-8 col-sm-10 col-md-9">
                    <h5 class="card-title">{{$pregunta->question}}</h5>
                </div>
                <div class="col-4 col-sm-2 col-md-3 col-faq" >
                    <ul class= "ulFAQ">
                        <li><a href="#" class="btn " data-toggle="modal" data-target="#Edit{{$pregunta->id}}"><i class="fas fa-pencil-alt"></i></a></li>
                        <li><a href="#" class="btn"  data-toggle="modal" data-target="#Delete{{$pregunta->id}}"><i class="fas fa-trash-alt"></i></a></li>
                    </ul>           
                </div>

              </div>
          <div class="card-body">
            <p class="card-text">{{$pregunta->answer}} </p>
          </div>
        </div>

         <!-- Modal Edit-->
        <div class="modal fade" id="Edit{{$pregunta->id}}" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Pregunta Frecuente</h5>
            </div>
              <div class="modal-body">
                <form form method="POST" action="{{ route('faqs.update',$pregunta->id) }}">
                    {{ csrf_field() }}
                  <div class="form-group">
                    <label>Pregunta</label>
                    <input type="hidden" name="_method" value="PUT">
                    <textarea rows="2" class="form-control" name="question">{{$pregunta->question}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Respuesta</label>
                    <textarea rows="4" class="form-control" name="answer">{{$pregunta->answer}}</textarea>
                  </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
            </div>
          </div>
        </div>

        <!-- Modal DELETE-->

        <div class="modal fade" id="Delete{{$pregunta->id}}" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">¿Desea eliminar esta pregunta?</h5>
            </div>
              <div class="modal-body">
        
                  <div class="form-group">
                    <label>Pregunta</label>
                    <textarea rows="2" class="form-control textareaReadOnly" name="question" readonly>{{$pregunta->question}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Respuesta</label>
                    <textarea rows="4" class="form-control textareaReadOnly" name="answer" readonly>{{$pregunta->answer}}</textarea>
                  </div>
                
              </div>
              <div class="modal-footer">
                <form form method="POST" action="{{ route('faqs.destroy',$pregunta->id) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                    
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerar</button>
              </div>
            </div>
          </div>
        </div>

       

        @endforeach


        <!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Nueva Pregunta Frecuente</h5>
              </div>
              <div class="modal-body">
                <form form method="POST" action="{{ route('faqs.store') }}">
                    {{ csrf_field() }}
                  <div class="form-group">
                    <label>Pregunta</label>
                    <textarea rows="2" class="form-control" name="question"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Respuesta</label>
                    <textarea rows="4" class="form-control" name="answer"></textarea>
                  </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
            </div>
          </div>
        </div>
        
@stop
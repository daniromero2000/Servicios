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
    .btn-FAQ{
      background-color: white !important;
    }
    .btn-FAQ:focus{
      box-shadow: unset;
    }
    .titelFAQ{
      margin-top: 30px; 
    }
   
    
</style>

      <div class="container">
        

      
    
        @if (Session::get('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
        
        <h1 class="menuItem-title text-center titelFAQ">Preguntas Frecuentes</h1>

        @foreach($preguntas as $pregunta)
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-default btn-FAQ" data-toggle="collapse" data-target="#collapse{{$pregunta->id}}" aria-expanded="true" aria-controls="collapseOne">
                  <h5 >{{$pregunta->question}}</h5> 
                </button>
              </h5>
            </div>

            <div id="collapse{{$pregunta->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                {{$pregunta->answer}}
              </div>
            </div>
          </div>
        </div>
        @endforeach

        

        </div>      
@stop
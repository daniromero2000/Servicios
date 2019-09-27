    <!--
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO FAQS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: view for FAQS CRUD
    **Date: 12/12/2018
     -->
@extends('layouts.app')
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-781153823"></script>
<script>
    window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);} gtag('js',new Date());gtag('config','AW-781153823',{'page_title':'Preguntas Frecuentes','page_path':'/preguntas-frecuentes'});
</script>
@section('title', 'Preguntas Frecuentes')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
      <div class="container">

        @if (Session::get('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
        
        <h1 class="menuItem-title text-center titelFAQ">Preguntas Frecuentes</h1>

        @php
            $show=true;
        @endphp
    <div id="accordion">
        @foreach($preguntas as $key => $pregunta)
        
          <div class="card cardFQA">
            <div class="card-header card-headerFQA" id="heading{{$pregunta->id}}">
                <button class="btn btn-default ourStores-titleStore btn-FAQ cardItem{{$key}}" data-toggle="collapse" data-target="#collapse{{$pregunta->id}}" aria-expanded="false" aria-controls="collapse{{$pregunta->id}}">
                    <div class="row rowFAQ">
                      <h5 class="h5FAQ">{{$pregunta->question}}</h5>
                      <i class="fas fa-angle-down downFAQ" name="collapse{{$pregunta->id}}"></i> 
                    </div>
                </button>
            </div>

            <div id="collapse{{$pregunta->id}}" class="collapse @if($show) @php echo 'show'; $show=false @endphp @endif" aria-labelledby="heading{{$pregunta->id}}" data-parent="#accordion">
              <div class="card-body">
                {!!$pregunta->answer!!}
              </div>
            </div>
          </div>
        
        @endforeach
        </div>
        </div> 
@stop
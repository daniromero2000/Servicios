@extends('layouts.app')
 
@section('content')

    <link rel="stylesheet" >
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
        <script>
            //document.getElementByClassName('show').style.color = "red";
            $( document ).ready(function() {
                
                var itemsArray=[];

                $('.cardFQA .card-headerFQA .btn-FAQ').each(function(index){
                    itemsArray.push(this);
                     
                });

                var clicksArray=[];

                var i=0;

                for(i;i<itemsArray.length;i++){
                    clicksArray.push('click'+i);

                }

                var obj = {};
                var j=0;
                for(j;j<itemsArray.length;j++){
                    if(j==0){
                        obj[clicksArray[j]]=1;
                        $(itemsArray[j]).find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
                    }
                    else{
                        obj[clicksArray[j]]=0;    
                    } 
                }

                function toggle (index) {
    
                    var down = true;
                    if (obj[clicksArray[index]]!=0) {
                        down=false;
                    }

                    for(j=0;j<itemsArray.length;j++){
                         obj[clicksArray[j]]=0;
                        $(itemsArray[j]).find('i').removeClass('fa-angle-up').addClass('fa-angle-down');
                    }

                    if (down){
                        obj[clicksArray[index]]=1;
                        $(itemsArray[index]).find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
                    }
                }

                 $('.cardFQA .card-headerFQA .btn-FAQ').each(function(index){
                    
                    $(this).click(function(){
                    
                    toggle(index);

                    });
                 });
                });

                

       
        </script>

@stop
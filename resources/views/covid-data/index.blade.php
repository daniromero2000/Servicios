@extends('layouts.app')
@include('layouts.front.layouts.googleAds')
@section('title', 'Covid-Data')


@section('content')
<div class="container text-center my-5">

    <h4 style=" font-size: 20px; font-family: sans-serif; margin-bottom: 16px; ">Alivios Financieros</h4>
    <object
        data="{{asset('/pdf/LGB-DIR-SUB-03-014 Alivios financieros COVID-19.pdf#toolbar=0&navpanes=0&scrollbar=0')}}"
        type="application/pdf" width="80%" height="800px">
        <p>Parece que tu navegador no puede leer PDF</p>
    </object>
</div>
@endsection
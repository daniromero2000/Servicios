    <!--
    **Project: SERVICIOS FINANCIEROS
    **Case of use: MODULO GARANTIAS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: public view to warranty terms and conditions
    **Date: 6/03/2019
     -->
@extends('layouts.BasicIncludes')

@section('content')
  
     <div>
        <div class="row resetRow TermsHeader">
            <div class="logoHeaderTerms">
                <a href="{{ url()->previous() }}"> <img src="{{ asset('images/warranty-oportunidades.png') }}" class="img-fluid" alt="Oportuya" /> </a>
            </div>
         </div>
         <h1 class="titleTerms text-center">TÉRMINOS Y CONDICIONES GARANTÍA LEGAL</h1>
        <div class="container">
            <p class="menuItem-text" align="justify">
                El artículo 7 de la ley 1480 del 2011 indica que la “garantía legal es una obligación que tiene todo
                productor o proveedor para responder por la calidad y buen funcionamiento de los productos que ha puesto
                a la venta para los consumidores”. El artículo 8 de la ley 1480 del 2011 determina que el “término de la
                garantía legal será el dispuesto por la ley o por la autoridad competente, a falta de disposición de
                obligatorio cumplimiento, será el enunciado por el productor  y/o proveedor”. Señor usuario este servicio
                lo presta el fabricante siempre y cuando este dentro del término vigente de la garantía legal, verifique
                su manual de funciones y/o factura, para mayor información se puede comunicar
                a los números: 01 8000 117 787 o (6) 33 58 557 en Pereira.
            </p>
        </div>
        <h1 class="titleTerms text-center">TÉRMINOS Y CONDICIONES GARANTÍA SUPLEMENTARIA</h1>
        <div class="container">
            <p class="menuItem-text" align="justify">
                El artículo 13 de la ley 1480 del 2011  denomina la “Garantía Suplementaria como la ampliación
                del término legal de la garantía o el mejoramiento de esta, la garantía suplementaria puede otorgarse
                de manera gratuita o de manera onerosa, el consumidor debe pagar un porcentaje adicional al precio
                de la cosa adquirida y además es necesario que este acepte de manera expresa pagar el costo” 
                Señor usuario este servicio lo presta la aseguradora siempre y cuando usted haya adquirido la
                garantía suplementaria, por favor verifique sus facturas, para mayor información se puede comunicar
                a los números: 01 8000 117 787 o (6) 33 58 557 en Pereira.
            </p>
        </div>
    </div>
@stop
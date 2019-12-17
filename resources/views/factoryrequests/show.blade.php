@extends('layouts.admin.app')
@section('content')
<section class="content border-0">
    <div class="content-header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 ">Regresar</a>
                    </div>
                    <div class="col-sm-8">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a
                                    href="/Administrator/dashboard/factoryrequests">Dashboard
                                    Solicitudes Fábrica</a>
                            <li class="breadcrumb-item active"><a href="/Administrator/factoryrequests">Solicitudes
                                    Fábrica</a></li>
                            <li class="breadcrumb-item active"><a href="">Detalle Solicitud</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

    </div>
    <section class="content border-0">
        @include('layouts.errors-and-messages')
        <div class="card border-0 ">
            <ul class="nav nav-tabs border-0" id="tablist" role="tablist">
                <li class="active" role="presentation">
                    <a class="nav-link active " data-toggle="tab" href="#info" role="tab"
                        aria-controls="home">Solicitud</a>
                </li>
                <li class="active" role="presentation">
                    <a class="nav-link " data-toggle="tab" href="#references" role="tab"
                        aria-controls="home">Referencias
                        Solicitud</a>
                </li>
                <li class="active" role="presentation">
                    <a class="nav-link " data-toggle="tab" href="#products" role="tab" aria-controls="home">Productos
                        Solicitud</a>
                </li>
                <li class="active" role="presentation">
                    <a class="nav-link" data-toggle="tab" href="#seguimiento" role="tab"
                        aria-controls="profile">Seguimiento</a>
                </li>
            </ul>
            <div class="tab-content mt-4" id="tabcontent">

                <div role="tabpanel" class="tab-pane container-fluid active" id="info">
                    @include('factoryrequests.layouts.generals')
                    @include('factoryrequests.layouts.creditcard')
                </div>
                <div role="tabpanel" class="tab-pane" id="references">
                    @include('factoryrequests.layouts.references', [ 'references' => $factoryRequest->references ])
                </div>
                <div role="tabpanel" class="tab-pane" id="products">
                    @include('factoryrequests.layouts.products')
                </div>
                <div role="tabpanel" class="tab-pane" id="seguimiento">
                    <div class="container-fluid">
                        <div class="row">
                            @include('factoryrequests.layouts.commentaries',['datas' => $factoryRequest->comments])
                            @include('factoryrequests.layouts.notes',['datas' => $factoryRequest->factoryRequestNotes])
                            {{-- @include('factoryrequests.layouts.statusesLog', ['datas' =>$factoryRequest->comments]) --}}
                        </div>
                    </div>
                </div>

                <div class="row row-reset border-0">
                    <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 ">Regresar</a>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection
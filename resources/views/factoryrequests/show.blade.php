@extends('layouts.admin.app')
@section('content')
<section class="content border-0">
    <div class="content-header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 ">
                        <ol class="breadcrumb bradcrumb-reset float-sm-right">
                            <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a
                                    href="/Administrator/dashboard/factoryrequests">Dashboard
                                    Solicitudes Fábrica</a>
                            <li class="breadcrumb-item active"><a href="/Administrator/factoryrequests">Solicitudes
                                    Fábrica</a></li>
                            <li class="breadcrumb-item active"><a href="">Detalle Solicitud</a></li>
                        </ol>
                    </div>
                    <div class="col-12 mt-2">
                        <a href="{{ URL::previous() }}"
                            class="btn btn-primary btn-sm-reset ml-auto mr-3 mb-2 ">Regresar</a>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

    </div>
    <section class="content border-0 m-2">
        @include('layouts.errors-and-messages')
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist" style=" border-bottom: 0px; ">
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
                        <a class="nav-link " data-toggle="tab" href="#products" role="tab"
                            aria-controls="home">Productos
                            Solicitud</a>
                    </li>
                    <li class="active" role="presentation">
                        <a class="nav-link" data-toggle="tab" href="#seguimiento" role="tab"
                            aria-controls="profile">Seguimiento</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div role="tabpanel" class="tab-pane fade container-fluid show active" id="info">
                        <div class="row">
                            <div class="col-sm-6 col-lg-5">
                                @include('factoryrequests.layouts.generals')
                            </div>
                            <div class="col-sm-6 col-lg-7">
                                @include('factoryrequests.layouts.creditcard')
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="references">
                        @include('factoryrequests.layouts.references', [ 'references' => $factoryRequest->references ])
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="products">
                        <div class="row">
                            <div class="col-sm-6">
                                @include('factoryrequests.layouts.products') </div>
                            <div class="col-sm-6">
                                @include('factoryrequests.layouts.products2') </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="seguimiento">
                        <div class="container-fluid">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <div class="row row-reset">
                                        @if ($timeFactory)
                                        <div class="col-12 col-sm-6">
                                            <div class="small-box bg-info">
                                                <div class="inner">
                                                    <h3 class="text-lg">Tiempo en Fábrica</h3>
                                                    <p> {{$timeFactory[0]}} {{$timeFactory[1]}}</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-clock"></i>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($timeSubsidiary)
                                        <div class="col-12 col-sm-6">
                                            <div class="small-box bg-success">
                                                <div class="inner">
                                                    <h3 class="text-lg">Tiempo en Sucursal</h3>
                                                    <p> {{$timeSubsidiary[0]}} {{$timeSubsidiary[1]}}</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-clock"></i>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-12 col-sm-6">
                                            @include('factoryrequests.layouts.commentaries',['datas' =>
                                            $factoryRequest->comments])
                                        </div>
                                        <div class="col-12 col-sm-6"> @include('factoryrequests.layouts.notes',['datas'
                                            =>
                                            $factoryRequest->factoryRequestNotes])
                                        </div>

                                    </div>
                                </div>
                                @include('factoryrequests.layouts.statusesLog', ['datas'
                                =>$factoryRequest->factoryRequestStatusesLogs])
                            </div>
                        </div>
                    </div>
                    <div class="row row-reset border-0">
                        <a href="{{ URL::previous() }}"
                            class="btn btn-primary btn-sm-reset ml-auto mr-3 mb-2 ">Regresar</a>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </section>
</section>
@endsection
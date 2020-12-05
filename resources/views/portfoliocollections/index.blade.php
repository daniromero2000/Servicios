@extends('layouts.admin.app')
@section('linkStyleSheets')
@endsection
@section('content')
    <section>
        @include('layouts.errors-and-messages')
        @if (!is_null($portfolioCollections))
            <div class="mx-auto" style="max-width: 1450px;">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-9 order-sm-last">
                                <ol class="breadcrumb bradcrumb-reset float-sm-right">
                                    <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                                    <li class="breadcrumb-item active"><a
                                            href="/Administrator/dashboard/factoryrequestTurns">Dashboard
                                            Turnos Fábrica</a>
                                    <li class="breadcrumb-item active"><a href="/Administrator/factoryrequestTurns">Turnos
                                            Fábrica</a></li>
                                </ol>
                            </div>
                            <div class="col-sm-3 mt-2 order-sm-first">
                                <a href="{{ URL::previous() }}"
                                    class="btn btn-primary ml-auto mr-3 mb-2 btn-sm-reset">Regresar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-md-12">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">Reportes</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                        class="fas fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6 col-sm-6 col-md-6">
                                                    <div class="small-box ">
                                                        <div class="inner">
                                                            <h2 class="titleCardNumber">
                                                                {{ $listCount }}
                                                            </h2>
                                                            @if (request()->input())
                                                                <p class="textCardNumber">Total de Recibos</p>
                                                            @else
                                                                <p class="textCardNumber">Recibos en este mes</p>
                                                            @endif
                                                        </div>
                                                        <div class="icon">
                                                            <i class="ion ion-stats-bars"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-sm-6 col-md-6">
                                                    <div class="small-box ">
                                                        <div class="inner">
                                                            <h2 class="titleCardNumber">Total</h2>
                                                            <p>
                                                                ${{ number_format($portfolioCollectionsTotal) }}</p>
                                                           
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-4 col-xl-3">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">Filtros</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                        class="fas fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            {{-- @include('layouts.admin.search_turns',
                                            ['route' => route('factoryrequestTurns.index')])
                                            --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-xl-9">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">Recibos</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                        class="fas fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body px-0">
                                            @if ($portfolioCollections)
                                                <div class="container-fluid mb-4">
                                                    <div class="card-body table-responsive p-0 height-table">
                                                        <table class="table table-head-fixed">
                                                            <thead class="header-table">
                                                                <tr>
                                                                    @foreach ($headers as $header)
                                                                        <th  class="text-center" scope="col">{{ $header }}</th>
                                                                    @endforeach
                                                                </tr>
                                                            </thead>
                                                            <tbody class="body-table">
                                                                @foreach ($portfolioCollections as $data)
                                                                    <tr>
                                                                        <td class="text-center">{{ $data->customer_id }}
                                                                        </td>
                                                                        <td class="text-center">{{ $data->user_id }} </td>
                                                                        <td class="text-center">$
                                                                            {{ number_format($data->amount) }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ $data->payment_reference }}
                                                                        </td>
                                                                        @if ($data->status == 0)
                                                                            <td class="text-center"><span
                                                                                    class="badge badge-warning">Pendiente</span>
                                                                            </td>
                                                                        @elseif($data->status == 1)
                                                                            <td class="text-center"><span
                                                                                    class="badge badge-success">Registrado</span>
                                                                            </td>
                                                                        @elseif($data->status == 2)
                                                                            <td class="text-center"><span
                                                                                    class="badge badge-danger">Error al
                                                                                    procesar</span> </td>
                                                                        @else
                                                                            <td class="text-center"><span
                                                                                    class="badge badge-primary">Anulado</span>
                                                                            </td>
                                                                        @endif
                                                                        <td class="text-center">{{ $data->created_at }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                @include('layouts.admin.pagination.pagination', [$skip])
                                            @else
                                                @include('layouts.admin.pagination.pagination_null', [$skip])
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endif
    </section>
@endsection

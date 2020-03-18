@extends('layouts.admin.app')
@section('linkStyleSheets')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection
@section('content')
<section class="content border-0">
    @include('layouts.errors-and-messages')
    <div class="container d-flex justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 col-xl-6">
            <div class="card mt-5 card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                                href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                                aria-selected="true">Tradicional</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                                href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                                aria-selected="false">Oportuya</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
                            aria-labelledby="custom-tabs-three-home-tab">
                            <div class="card">
                                <div class="card-header">
                                    Actualizar póliza seguro deudores
                                </div>
                                <div class="card-body">

                                    <div class="form-group">

                                        <div class="row d-flex justify-content-center ">
                                            <div class="col-10 col-sm-6">
                                                <label for="my-input">Solicitud</label>
                                                <input id="soliDebtor" class="form-control" type="text">
                                            </div>
                                            <div
                                                class="col-4 mt-4 d-flex justify-content-center justify-content-sm-start">
                                                <div class="mt-1" id="ButtonCustomerSearch">
                                                    <button type="button" id="debtor" data-toggle="modal"
                                                        data-target="#exampleModal" class="btn btn-primary">
                                                        Buscar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Resultado:</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('DebtorInsuranceController.store') }}"
                                                        id="actionForm" method="POST" class="form"
                                                        enctype="multipart/form-data">
                                                        {{ csrf_field() }}

                                                        <div class="form-group">
                                                            <input type="text" hidden id="solic" name="SOLIC">
                                                            <input type="text" hidden id="sucursalCustomer"
                                                                name="sucursalCustomer">
                                                            <div class="row">
                                                                <div class="col-6" hidden>
                                                                    <label for="my-input">Cedula</label>
                                                                    <input id="identification" class="form-control"
                                                                        type="text" name="identificationNumberCustomer">
                                                                </div>
                                                                <div class="col-12 col-md-6">
                                                                    <label for="my-input">Cédula Beneficiario</label>
                                                                    <input id="identificationNumberDebtor"
                                                                        class="form-control" type="text"
                                                                        name="CEDULA_BEN">
                                                                </div>
                                                                <div class="col-12 col-md-6">
                                                                    <label for="my-input">Parentesco</label>
                                                                    <select name="PARENTESCO" class="form-control"
                                                                        id="parenterDebtor">
                                                                        <option value="" disabled selected>Selecione
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="my-input">Beneficiario</label>
                                                                    <input id="nameDebtor" class="form-control"
                                                                        type="text" name="BENEFI">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="modal-footer pl-0 pb-0 d-flex justify-content-start">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-dismiss="modal">Cerrar</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Actualizar</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                            aria-labelledby="custom-tabs-three-profile-tab">
                            <div class="card">
                                <div class="card-header">
                                    Actualizar póliza seguro deudores
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <form action="/Administrator/Insurance/Policy/Debtors">
                                            <div class="row d-flex justify-content-center ">
                                                <div class="col-10 col-sm-6">
                                                    <label for="my-input">Cédula</label>
                                                    <input id="identificationOportuya" class="form-control" type="text"
                                                        name="identification">
                                                </div>
                                                <div
                                                    class="col-4 mt-4 d-flex justify-content-center justify-content-sm-start">
                                                    <div class="mt-1">
                                                        <button type="button" id="debtorOportuya" data-toggle="modal"
                                                            data-target="#exampleModal2" class="btn btn-primary">
                                                            Buscar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Resultado:</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('DebtorInsuranceOportuya.store') }}"
                                                        id="actionForm" method="POST" class="form"
                                                        enctype="multipart/form-data">
                                                        {{ csrf_field() }}

                                                        <div class="form-group">
                                                            <input type="text" hidden id="customerOportuya"
                                                                name="identificationNumberCustomer">
                                                            <input type="text" hidden id="sucursalCustomerOportuya"
                                                                name="sucursalCustomer">
                                                            <div class="row">
                                                                <div class="col-12 col-md-6">
                                                                    <label for="my-input">Cédula Beneficiario</label>
                                                                    <input id="identificationNumberDebtorOportuya"
                                                                        class="form-control" type="text"
                                                                        name="CEDULA_BEN">
                                                                </div>
                                                                <div class="col-12 col-md-6">
                                                                    <label for="my-input">Parentesco</label>
                                                                    <select name="PARENTESCO" class="form-control"
                                                                        id="parenterDebtorOportuya">
                                                                        <option value="" disabled selected>Selecione
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="my-input">Beneficiario</label>
                                                                    <input id="nameDebtorOportuya" class="form-control"
                                                                        type="text" name="BENEFI">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="modal-footer pl-0 pb-0 d-flex justify-content-start">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-dismiss="modal">Cerrar</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Actualizar</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>



    </div>
</section>
@endsection
@section('scriptsJs')
<script src="{{ asset('js/UpdateInsurancePolicyDebtors.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
@endsection
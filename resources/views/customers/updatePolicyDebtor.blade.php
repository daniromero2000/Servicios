@extends('layouts.admin.app')
@section('content')
<section class="content border-0">
    @include('layouts.errors-and-messages')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                Actualizar póliza seguro deudores
            </div>
            <div class="card-body">

                <div class="form-group">
                    <form action="/Administrator/Insurance/Policy/Debtors">
                        <div class="row d-flex justify-content-center ">
                            <div class="col-3">
                                <label for="my-input">Cédula</label>
                                <input id="identification" class="form-control" type="text" name="identification">
                            </div>
                            <div class="col-3">
                                <label for="my-input">Tipo de cliente</label>
                                <select name="typeClients" class="form-control" id="typeClients">
                                    <option value="" disabled selected>Selecione</option>
                                    <option value="Tradicional">Tradicional</option>
                                    <option value="Oportuya">Oportuya</option>
                                </select>
                            </div>
                            <div class="col-3 mt-4">
                                <div class="mt-1" id="ButtonCustomerSearch">

                                    {{-- <button type="button" id="debtor" data-toggle="modal" data-target="#exampleModal"
                                        class="btn btn-primary">
                                        Buscar
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Resultado:</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('DebtorInsuranceController.store') }}" id="actionForm"
                                    method="POST" class="form" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <input type="text" hidden id="customer" name="identificationNumberCustomer">
                                        <input type="text" hidden id="sucursalCustomer" name="sucursalCustomer">
                                        <div class="row d-flex justify-content-center ">
                                            <div class="col-6">
                                                <label for="my-input">Solicitud</label>
                                                <input id="solicDebtor" class="form-control" type="text" name="SOLIC">
                                            </div>
                                            <div class="col-6">
                                                <label for="my-input">Cédula Beneficiario</label>
                                                <input id="identificationNumberDebtor" class="form-control" type="text"
                                                    name="CEDULA_BEN">
                                            </div>
                                            <div class="col-6">
                                                <label for="my-input">Beneficiario</label>
                                                <input id="nameDebtor" class="form-control" type="text" name="BENEFI">
                                            </div>
                                            <div class="col-6">
                                                <label for="my-input">Parentesco</label>
                                                <select name="PARENTESCO" class="form-control" id="parenterDebtor">
                                                    <option value="" disabled selected>Selecione</option>
                                                    <option value="Tradicional">Tradicional</option>
                                                    <option value="Oportuya">Oportuya</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-start">
                                        <button type="button" class="btn btn-danger"
                                            data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
@section('scriptsJs')
<script src="{{ asset('js/UpdateInsurancePolicyDebtors.js') }}"></script>
@endsection
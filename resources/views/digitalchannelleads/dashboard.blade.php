@extends('layouts.admin.app')
@section('content')
<div class="container-fluid">
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary card-outline card-outline-tabs">
          <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="generals-tab" data-toggle="pill" href="#generals" role="tab"
                  aria-controls="generals" aria-selected="false">General</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " id="digitalChanels-tab" data-toggle="pill" href="#digitalChanels" role="tab"
                  aria-controls="custom-tabs-three-settings" aria-selected="true">Canal Digital</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="insurances-tab" data-toggle="pill" href="#insurances" role="tab"
                  aria-controls="insurances" aria-selected="false">Seguros</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="warranties-tab" data-toggle="pill" href="#warranties" role="tab"
                  aria-controls="warranties" aria-selected="false">Garantias</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="ecommerce-tab" data-toggle="pill" href="#ecommerce" role="tab"
                  aria-controls="ecommerce" aria-selected="false">Ecommerce</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="callCenter-tab" data-toggle="pill" href="#callCenter" role="tab"
                  aria-controls="callCenter" aria-selected="false">Call Center</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="oportuyas-tab" data-toggle="pill" href="#oportuyas" role="tab"
                  aria-controls="oportuyas" aria-selected="false">Oportuya</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="advancedUnit-tab" data-toggle="pill" href="#advancedUnit" role="tab"
                  aria-controls="advancedUnit" aria-selected="false">Unidad Avanzada</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="wallets-tab" data-toggle="pill" href="#wallets" role="tab"
                  aria-controls="wallets" aria-selected="false">Cartera</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="juridicales-tab" data-toggle="pill" href="#juridicales" role="tab"
                  aria-controls="juridicales" aria-selected="false">Juridica</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="libranzas-tab" data-toggle="pill" href="#libranzas" role="tab"
                  aria-controls="libranzas" aria-selected="false">Libranzas</a>
              </li>


            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
              <div class="tab-pane fade" id="custom-tabs-three-home" role="tabpanel"
                aria-labelledby="custom-tabs-three-home-tab">
              </div>
              <div class="tab-pane fade active show" id="generals" role="tabpanel" aria-labelledby="generals-tab">
                <div class="row mt-3">
                  <div class="col-sm-12 col-md-5 col-lg-4">
                    <div class="col-12 col-sm-12">
                      <div class="row d-flex justify-content-center">
                        <div class="col-12 ">
                          <div class="row">
                            <div class="col-12 ">
                              @include('digitalchannelleads.layouts.card_total_leads')
                            </div>
                            <div class="col-12 ">
                              @include('digitalchannelleads.layouts.card_total_quotes')
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="info-box ">
                        <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                          <div class="row">
                            <div class="col-6">
                              <span class="info-box-text">Vendidos</span>
                              <span class="info-box-number"> ${{number_format($leadpriceTotal)}}</span>
                            </div>
                            <div class="col-6">
                              <span class="info-box-text text-right"><a href="/Administrator/digitalchannelleads"
                                  style="color: black; !important">Ver
                                  Más</a></span>
                            </div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @include('digitalchannelleads.layouts.pie_channels')
                    @include('digitalchannelleads.layouts.pie_statuses.pie_statuses')
                    @include('digitalchannelleads.layouts.pie_assessors')
                  </div>
                  <div class="col-md-8">
                    @include('digitalchannelleads.layouts.bar_statuses')
                    <div class="row">
                      <div class="col-12 ">
                        @include('digitalchannelleads.layouts.pie_products.pie_products')
                        @include('digitalchannelleads.layouts.pie_services.pie_service')
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="digitalChanels" role="tabpanel" aria-labelledby="digitalChanels-tab">
                <div class="row">
                  <div class="col-12 col-md-4">
                    <div class="col-12 col-sm-12">
                      <div class="row d-flex justify-content-center">
                        <div class="col-12 ">
                          <div class="row">
                            <div class="col-12 ">
                              @include('digitalchannelleads.layouts.card_total_leads_digitalChanel')
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @include('digitalchannelleads.layouts.pie_statuses.pie_statuses_digitalChanel')
                  </div>
                  <div class="col-12 col-md-8">
                    @include('digitalchannelleads.layouts.pie_services.pie_service_digitalChanel')
                    @include('digitalchannelleads.layouts.pie_products.pie_products_digitalChanel')
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="insurances" role="tabpanel" aria-labelledby="insurances-tab">
                <div class="row">
                  <div class="col-12 col-md-4">
                    <div class="col-12 col-sm-12">
                      <div class="row d-flex justify-content-center">
                        <div class="col-12 ">
                          <div class="row">
                            <div class="col-12 ">
                              @include('digitalchannelleads.layouts.card_total_leads_insurances')
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @include('digitalchannelleads.layouts.pie_statuses.pie_statuses_insurances')
                  </div>
                  <div class="col-12 col-md-8">
                    @include('digitalchannelleads.layouts.pie_services.pie_serviceInsurances')
                    @include('digitalchannelleads.layouts.pie_products.pie_products_Insurance')
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="warranties" role="tabpanel" aria-labelledby="warranties-tab">
                <div class="row">
                  <div class="col-12 col-md-4">
                    <div class="col-12 col-sm-12">
                      <div class="row d-flex justify-content-center">
                        <div class="col-12 ">
                          <div class="row">
                            <div class="col-12 ">
                              @include('digitalchannelleads.layouts.card_total_leads_warranties')
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @include('digitalchannelleads.layouts.pie_statuses.pie_statuses_warranties')
                  </div>
                  <div class="col-12 col-md-8">
                    @include('digitalchannelleads.layouts.pie_services.pie_serviceWarranties')
                    @include('digitalchannelleads.layouts.pie_products.pie_products_warranties')
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="ecommerce" role="tabpanel" aria-labelledby="ecommerce-tab">
                <div class="row">
                  <div class="col-12 col-md-4">
                    <div class="col-12 col-sm-12">
                      <div class="row d-flex justify-content-center">
                        <div class="col-12 ">
                          <div class="row">
                            <div class="col-12 ">
                              @include('digitalchannelleads.layouts.card_total_leads_ecommerce')
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @include('digitalchannelleads.layouts.pie_statuses.pie_statuses_Ecommerces')
                  </div>
                  <div class="col-12 col-md-8">
                    @include('digitalchannelleads.layouts.pie_services.pie_serviceEcommerces')
                    @include('digitalchannelleads.layouts.pie_products.pie_products_ecommerces')
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="callCenter" role="tabpanel" aria-labelledby="callCenter-tab">
                <div class="row">
                  <div class="col-12 col-md-4">
                    <div class="col-12 col-sm-12">
                      <div class="row d-flex justify-content-center">
                        <div class="col-12 ">
                          <div class="row">
                            <div class="col-12 ">
                              @include('digitalchannelleads.layouts.card_total_leads_callCenter')
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @include('digitalchannelleads.layouts.pie_statuses.pie_statuses_callCenter')
                  </div>
                  <div class="col-12 col-md-8">
                    @include('digitalchannelleads.layouts.pie_services.pie_serviceCallCenter')
                    @include('digitalchannelleads.layouts.pie_products.pie_products_callCenter')
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="oportuyas" role="tabpanel" aria-labelledby="oportuyas-tab">
                <div class="row">
                  <div class="col-12 col-md-4">
                    <div class="col-12 col-sm-12">
                      <div class="row d-flex justify-content-center">
                        <div class="col-12 ">
                          <div class="row">
                            <div class="col-12 ">
                              @include('digitalchannelleads.layouts.card_total_leads_oportuyas')
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @include('digitalchannelleads.layouts.pie_statuses.pie_statuses_oportuyas')
                  </div>
                  <div class="col-12 col-md-8">
                    @include('digitalchannelleads.layouts.pie_services.pie_serviceOportuyas')
                    @include('digitalchannelleads.layouts.pie_products.pie_products_oportuya')
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="advancedUnit" role="tabpanel" aria-labelledby="advancedUnit-tab">
                <div class="row">
                  <div class="col-12 col-md-4">
                    <div class="col-12 col-sm-12">
                      <div class="row d-flex justify-content-center">
                        <div class="col-12 ">
                          <div class="row">
                            <div class="col-12 ">
                              @include('digitalchannelleads.layouts.card_total_leads_AdvancedUnit')
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @include('digitalchannelleads.layouts.pie_statuses.pie_statuses_AdvancedUnit')
                  </div>
                  <div class="col-12 col-md-8">
                    @include('digitalchannelleads.layouts.pie_services.pie_serviceAdvancedUnit')
                    @include('digitalchannelleads.layouts.pie_products.pie_products_advanceUnit')
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="wallets" role="tabpanel" aria-labelledby="wallets-tab">
                <div class="row">
                  <div class="col-12 col-md-4">
                    <div class="col-12 col-sm-12">
                      <div class="row d-flex justify-content-center">
                        <div class="col-12 ">
                          <div class="row">
                            <div class="col-12 ">
                              @include('digitalchannelleads.layouts.card_total_leads_Wallets')
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @include('digitalchannelleads.layouts.pie_statuses.pie_statuses_Wallets')
                  </div>
                  <div class="col-12 col-md-8">
                    @include('digitalchannelleads.layouts.pie_services.pie_serviceWallets')
                    @include('digitalchannelleads.layouts.pie_products.pie_products_wallets')
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="juridicales" role="tabpanel" aria-labelledby="juridicales-tab">
                <div class="row">
                  <div class="col-12 col-md-4">
                    <div class="col-12 col-sm-12">
                      <div class="row d-flex justify-content-center">
                        <div class="col-12 ">
                          <div class="row">
                            <div class="col-12 ">
                              @include('digitalchannelleads.layouts.card_total_leads_Juridicales')
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @include('digitalchannelleads.layouts.pie_statuses.pie_statuses_Juridicales')
                  </div>
                  <div class="col-12 col-md-8">
                    @include('digitalchannelleads.layouts.pie_services.pie_serviceJuridicales')
                    @include('digitalchannelleads.layouts.pie_products.pie_products_juridical')
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="libranzas" role="tabpanel" aria-labelledby="libranzas-tab">
                <div class="row">
                  <div class="col-12 col-md-4">
                    <div class="col-12 col-sm-12">
                      <div class="row d-flex justify-content-center">
                        <div class="col-12 ">
                          <div class="row">
                            <div class="col-12 ">
                              @include('digitalchannelleads.layouts.card_total_leads_Libranzas')
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @include('digitalchannelleads.layouts.pie_statuses.pie_statuses_Libranzas')
                  </div>
                  <div class="col-12 col-md-8">
                    @include('digitalchannelleads.layouts.pie_services.pie_serviceLibranzas')
                    @include('digitalchannelleads.layouts.pie_products.pie_products_libranza')
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <!-- AREA CHART DEBE IR OCULTA-->
        <div hidden class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Area Chart</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="areaChart" style="height:250px; min-height:250px"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@include('layouts.admin.dashboard_imports')
@include('digitalchannelleads.dashboardJS')
@endsection
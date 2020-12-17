  <div id="header">
      <div class="row">
          <div class="col-12 col-sm-12 col-lg-4 resetCol headerImage">
              <div class="header-containerLogo">
                  <a href="/">
                      <img src="{{ asset('images/oportunidadesServiciosFinancierosLogo.png') }}"
                          alt="Oportunidades Servicios Financieros" class="img-fluid">
                  </a>
              </div>
          </div>

          <div class="col-12 col-sm-12  col-lg-8 resetCol toggleResponsive">
              <div class="buttonResponsive">
                  <div class="innerButtonResponsive"></div>
                  <div class="innerButtonResponsive1"></div>
                  <div class="innerButtonResponsive2"></div>
              </div>
              <div class="header-containerItemsResponsive header-item1" id="navbarNavAltMarkup">
                  <div class="navbar-nav header-menu">
                      <a class="nav-item nav-link header-item header-item1"
                          href="{{ url('credito-electrodomesticos/catalogo') }}">
                          <span class="header-textoItem">Crédito Electrodomésticos</span>
                      </a>
                      <a class="nav-item nav-link header-item header-item1" href="/libranza">
                          <span class="header-textoItem">Libranza</span>
                      </a>
                      <a class="nav-item nav-link header-item header-item1" href="/motos">
                          <span class="header-textoItem">Crédito motos</span>
                      </a>
                      <a class="nav-item nav-link header-item header-item1" href="/avance">
                          <span class="header-textoItem">Avances</span>
                      </a>
                      <a class="nav-item nav-link header-item header-item1" href="/seguros">
                          <span class="header-textoItem">Seguros</span>
                      </a>
                      <a class="nav-item nav-link header-item header-item1" href="/digitalWarranty">
                          <span class="header-textoItem">Garantía digital</span>
                      </a>
                  </div>
              </div>
              <nav class="navbar header-menu navbar-expand-lg navbar-light navBarHide">
                  <div class="collapse navbar-collapse header-containerItems" id="navbarNavAltMarkup">
                      <div class="navbar-nav header-menu @php echo $barraOportuya @endphp">
                          <a class="nav-item nav-link header-item header-item1 @php echo $activeOportuya @endphp"
                              href="/credito-electrodomesticos/catalogo">
                              <span class="header-textoItem">Crédito Electrodomésticos</span>
                          </a>

                          <a class="nav-item nav-link header-item header-item3 @php echo $activeLibranza @endphp "
                              href="/libranza">
                              <img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Menú"
                                  class="img-fluid imgSombraMenu"> <span class="header-textoItem">Libranza</span>
                          </a>
                          <a class="nav-item nav-link header-item header-item4 @php echo $activeAvance @endphp "
                              href="/avance">
                              <img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Menú"
                                  class="img-fluid imgSombraMenu"> <span class="header-textoItem">Avances</span>
                          </a>
                          <a class="nav-item nav-link header-item header-item5 @php echo $activeSeguros @endphp "
                              href="/seguros">
                              <img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Menú"
                                  class="img-fluid imgSombraMenu"> <span class="header-textoItem">Seguros</span>
                          </a>
                          {{-- <a
                              class="nav-item nav-link header-item header-item6 @php echo $activeViajes @endphp "
                              href="/viajes">
                              <img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Menú"
                                  class="img-fluid imgSombraMenu"> <span class="header-textoItem">Viajes</span>
                          </a> --}}
                          <a class="nav-item nav-link header-item header-item2 @php echo $activeMotos @endphp"
                              href="/credito-electrodomesticos/catalogo">
                              <img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Menú"
                                  class="img-fluid imgSombraMenu"> <span class="header-textoItem">
                                  Oportucrédito </span>
                          </a>
                          <a class="nav-item nav-link header-item header-item7 @php echo $activeWarranty @endphp "
                              href="/digitalWarranty">
                              <img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Menú"
                                  class="img-fluid imgSombraMenu"> <span class="header-textoItem">Garantía
                                  digital</span>
                          </a>
                      </div>
                  </div>
              </nav>
          </div>
      </div>

  </div>

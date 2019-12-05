<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- SEARCH FORM -->

  <nav class="navbar navbar-static-top" style="margin-left: auto !important;"> <a href="#" class="sidebar-toggle"
      data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
      <span class="icon-bar"></span> </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle text-decoretion-none" data-toggle="dropdown"> <img
              src="{{ asset('images/analista1.png') }}" class="user-image" alt="User Image"> <span
              class="hidden-xs text-decoration-none color-gray">{{ auth()->user()->name }}</span> </a>


          <ul class="dropdown-menu">
            <!-- Default box -->
            <div class="row d-flex align-items-stretch">
              <div class="col-12 col-sm-6 col-md-12 align-items-stretch">
                <div class="card bg-light" style="margin: 0px;">
                  <div class="card-header text-muted border-bottom-0">
                    Asesor
                  </div>
                  <div class="card-body pt-0">
                    <div class="row ">
                      <div class="col-7 d-flex m-auto">
                        <h2 class="lead"><b>{{ auth()->user()->name }}</b></h2>

                      </div>
                      <div class="col-5 text-center">
                        <img src="{{ asset('images/analista1.png') }}" alt="" class="img-circle img-fluid">
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-12">
                        <p class="text-muted small text-sm" style="margin-bottom: 0px;"><i
                            class="fas fa-md fa-envelope"> </i> {{ auth()->user()->email }}</p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-code"></i></span>
                            {{ auth()->user()->codeOportudata }}</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-4">
                        <a href="/Administrator/profile/users" class="btn btn-sm btn-primary">
                          <i class="far fa-user"></i> Perfil
                        </a>
                      </div>
                      <div class="col-5 text-right">
                        <a href="#" class="btn btn-sm bg-teal " style="height: 100%;">
                          <i class="fas fa-comments mt-1"></i>
                        </a>
                      </div>
                      <div class="col-3">
                        <a href=" {{ route('logout') }}" class="btn btn-sm btn-danger">
                          <i class="fas fa-power-off"></i> Salir
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </ul>
        </li>

      </ul>


    </div>

  </nav>


</nav>
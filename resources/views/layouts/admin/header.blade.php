
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="index3.html" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contact</a>
    </li>
  </ul>

  <!-- SEARCH FORM -->
  <form class="form-inline ml-3">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </form>

  <header class="main-header" style="margin-left: auto !important;">
    <a href="}}" class="logo">
      <span class="logo-lg">
        <img src="{{asset('/images/lagobo_logo.png')}}" alt="Model" width="70">
      </span>
    </a>
    <nav class="navbar navbar-static-top"> <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
        <span class="icon-bar"></span> </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="{{ asset('images/analista1.png') }}"
                class="user-image" alt="User Image"> <span class="hidden-xs text-decoration-none color-gray">{{ auth()->user()->name }}</span> </a>
                
            <ul class="dropdown-menu">
              <li class="user-header"> <img src="{{ asset('images/analista1.png') }}" class="img-circle"
                  alt="User Image">
                <p> {{ auth()->user()->name }} <small>Miembro desde el {{ date('d/m/Y', strtotime( auth()->user()->created_at)) }}
                  </small></p>
              </li>
              <li class="user-body"></li>
              <li class="user-footer">
                <div class="pull-left"> <a href="" class="btn btn-default btn-flat">Perfil</a></div>
                <div class="pull-right"> <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Salir</a></div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</nav>
@php
    $modules = session('modules');
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/adminlte" class="brand-link">
    <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
      <span class="brand-text font-weight-light"> Oportudata</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block"></a>
            </div>
          </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
        data-accordion="false" >
        <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->


        <li class="nav-item has-treeview">
          <a class="nav-link" href="#modulesDashboard" >
            <i class="nav-icon fas fa-tree"></i>
            <p>
              Modulos
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" id="dashboardContent">
            <li class="nav-item">
              @foreach ($modules as $module)
                  <div class="nav-link" ng-repeat="module in modules">
                    <a href="{{ $module->route}}" >
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{ $module->name }}</p>
                    </a>
                  </div>
              @endforeach
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Contactos
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../forms/general.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>General Elements</p>
              </a>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Calendario
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../tables/simple.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Simple Tables</p>
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

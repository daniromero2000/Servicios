@php
$modules = session('modules');
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/Administrator/dashboard" class="brand-link">
    <img src="{{ asset('/images/bolitas.png') }}" alt="Oportudata" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"> Oportudata</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav  nav-sidebar flex-column nav-flat" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
          <a class="nav-link" href="#modulesDashboard">
            <i class="nav-icon fab fa-whmcs"></i>
            <p>
              Modulos
            </p>
          </a>
          <ul class="nav nav-treeview" id="dashboardContent">
            <li class="nav-item">
              @foreach ($modules as $module)
              <div class="nav-link" ng-repeat="module in modules">
                <a href="{{ $module->route}}">
                  <i class="{{ $module->icon}} nav-icon"></i>
                  <p>{{ $module->name }}</p>
                </a>
              </div>
              @endforeach
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

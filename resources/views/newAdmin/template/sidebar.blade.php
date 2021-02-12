    @php
        $modules = session('modules');
    @endphp
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}">
                <i class="ni ni-shop text-primary"></i>
                <span class="nav-link-text">Dashboards</span>
            </a>
        </li>
        @foreach ($modules as $key => $module)
            {{-- <div class="nav-link" ng-repeat="module in modules">
              <a href="{{ $module->route }}">
                  <i class="{{ $module->icon }} nav-icon"></i>
                  <p>{{ $module->name }}</p>
              </a>
          </div> --}}
            <li class="nav-item">
                <a class="nav-link" href="#navbar-components{{ $key }}" data-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="navbar-components{{ $key }}">
                    <i class="{{ $module->icon }}"></i>
                    <span class="nav-link-text">{{ $module->name }}</span>
                </a>
                <div class="collapse" id="navbar-components{{ $key }}">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ $module->route }}" class=" nav-link">Ver modulo</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ $module->route.'/create' }}" class=" nav-link">Crear registo</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endforeach
    </ul>

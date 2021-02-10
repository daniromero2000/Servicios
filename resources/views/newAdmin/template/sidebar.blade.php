  <ul class="navbar-nav">
      <li class="nav-item">
          {{-- <a class="nav-link {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}" href="{{route('admin.dashboard')}}" >
              <i class="ni ni-shop text-primary"></i>
              <span class="nav-link-text">Dashboards</span>
          </a> --}}
      </li>
      <li class="nav-item">
          {{-- <a class="nav-link {{ request()->segment(2) == 'answers' ? 'active' : '' }}" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="{{ request()->segment(2) == 'answers' ? 'true' : 'false' }}"
              aria-controls="navbar-examples">
              <i class="ni ni-ungroup text-orange"></i>
              <span class="nav-link-text">Preguntas</span>
          </a>
          <div class="collapse {{ request()->segment(2) == 'answers' ? 'show' : '' }}" id="navbar-examples">
              <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                      <a href="{{route('admin.answers.index')}}" class="nav-link">Ver Preguntas</a>
                  </li>
                  <li class="nav-item">
                      <a href="{{route('admin.answers.create')}}" class="nav-link">Crear Pregunta</a>
                  </li>
              </ul>
          </div> --}}
      </li>
      <li class="nav-item">
          <a class="nav-link" href="#navbar-components" data-toggle="collapse" role="button" aria-expanded="false"
              aria-controls="navbar-components">
              <i class="ni ni-ui-04 text-info"></i>
              <span class="nav-link-text">Categorias</span>
          </a>
          <div class="collapse" id="navbar-components">
              <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                      <a class="nav-link">Ver Categorias</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link">Crear Categoria</a>
                  </li>
                  {{-- <li class="nav-item">
                      <a href="#navbar-multilevel" class="nav-link" data-toggle="collapse" role="button"
                          aria-expanded="true" aria-controls="navbar-multilevel">Multi level</a>
                      <div class="collapse show" id="navbar-multilevel" style="">
                          <ul class="nav nav-sm flex-column">
                              <li class="nav-item">
                                  <a href="#!" class="nav-link ">Third level menu</a>
                              </li>
                              <li class="nav-item">
                                  <a href="#!" class="nav-link ">Just another link</a>
                              </li>
                              <li class="nav-item">
                                  <a href="#!" class="nav-link ">One last link</a>
                              </li>
                          </ul>
                      </div>
                  </li> --}}
              </ul>
          </div>
      </li>
  </ul>

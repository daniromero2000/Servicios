  @include('generals::layouts.errors-and-messages')
  <div class="card">
      <div class="card-header border-0">
          <h3 class="mb-0">{{ $title }}</h3>
          @include('leads::admin.leads.layouts.search', ['route' => route('admin.leads.index')])
      </div>
      @if (!$list->isEmpty())

          <div class="table-responsive">
              <table class="table align-items-center table-flush table-hover">
                  <thead class="thead-light">
                      <tr>
                          @foreach ($headers as $header)
                              <th class="text-center">{{ $header }}</th>
                          @endforeach
                      </tr>
                  </thead>
                  <tbody class="list">
                      @foreach ($list as $data)
                          <tr class="text-center">
                              @foreach ($data->toArray() as $key2 => $value)
                                  @if (!is_array($value))
                                      <td class="text-center">
                                          {{ $value }}
                                      </td>
                                  @endif
                              @endforeach
                          </tr>
                          @include('leads::admin.leads.layouts.modal_update')
                      @endforeach
                  </tbody>
              </table>
          </div>
          <div class="card-footer py-2">
              @include('generals::layouts.admin.pagination.pagination', [$skip])
          </div>
      @else
          <div class="card-footer py-2">
              @include('generals::layouts.admin.pagination.pagination_null', [$skip, $optionsRoutes])
          </div>
      @endif

  </div>

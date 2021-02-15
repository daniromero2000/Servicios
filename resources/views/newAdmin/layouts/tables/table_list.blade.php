  @include('newAdmin.layouts.errors-and-messages')
  <div class="card">
      <div class="card-header border-0">
          <h3 class="mb-0">{{ $title }}</h3>
          @include('newAdmin.layouts.search.search', ['route' => route("$optionsRoutes.index")])
      </div>
      @if (!empty($list->toArray()))
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
                              @foreach ($data->toArray() as $index => $value)
                                  @if (!is_array($value) && $index != 'id')
                                      @if ($index == 'created_at')
                                          <td class="text-center">{{ $data->created_at }}</td>
                                      @elseif($index == 'is_active')
                                          <td class="text-center">
                                              @include('newAdmin.layouts.status', ['status' => $data->is_active])
                                          </td>
                                      @elseif($index == 'status')
                                          <td class="text-center">
                                              <span class="badge"
                                                  style="color:{{ $value ? $value['color'] : '#FFFFFF' }}; background:{{ $value ? $value['background'] : '#007bff' }} ">
                                                  {{ $value['status'] }}</span>
                                          </td>
                                      @elseif($index == 'src')
                                          <td><a href={{ route("$optionsRoutes.index", "id=$data->id") }}><i
                                                      class="far fa-eye"></i></a></td>
                                      @else
                                          <td class="text-center">
                                              {{ $value }}
                                          </td>
                                      @endif
                                  @endif
                              @endforeach
                              <td class="text-center">
                                  <a data-toggle="modal" data-target="#modal{{ $data->id }}" href=""
                                      class="table-action table-action" data-toggle="tooltip"
                                      data-original-title="{{ $data->id }}">
                                      <i class="fas fa-edit"></i>
                                  </a>
                                  <a href="{{ route($optionsRoutes.'.show', $data->id) }}"
                                      class=" table-action table-action" data-toggle="tooltip"
                                      data-original-title="Ver">
                                      <i class="fas fa-eye"></i>
                                  </a>
                              </td>
                          </tr>
                          @include('newAdmin.layouts.modals.modal_update')
                      @endforeach
                  </tbody>
              </table>
          </div>
          <div class="card-footer py-2">
              @include('newAdmin.layouts.pagination.pagination', [$skip])
          </div>
      @else
          <div class="card-footer py-2">
              @include('newAdmin.layouts.pagination.pagination_null', [$skip, $optionsRoutes])
          </div>
      @endif
  </div>

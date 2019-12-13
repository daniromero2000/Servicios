<div class="container-fluid card card-table-reset">
  <div class="card-header">
    <div class="row">
      <div class="col-8">
        <h2 class="title-table"><i class="fas fa-user mr-2"></i> Referencias </h2>
      </div>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-10 col-lg-6">
      <div class="card mt-4">
        <div class="card-body table-responsive pt-1">
          <h4>Referencia Personal 1</h4>
          @if($references->isNotEmpty())
          <table class="table table-hover table-stripped leadTable">
            <thead class="header-table">
              <tr>
                <th class="text-center" scope="col">Nombre</th>
                <th class="text-center" scope="col">Dirección</th>
                <th class="text-center" scope="col">Barrio</th>
                <th class="text-center" scope="col">Celular</th>
                <th class="text-center" scope="col">Ciudad</th>

              </tr>
            </thead>
            <tbody class="body-table">
              @foreach ($references as $reference)

              <tr>
                <td class="text-center">{{ $reference->NOM_REFPER}}</td>
                <td class="text-center">{{ $reference->DIR_REFPER}}</td>
                <td class="text-center">{{ $reference->BAR_REFPER }}</td>
                <td class="text-center">{{ $reference->TEL_REFPER }}</td>
                <td class="text-center">{{ $reference->CIU_REFPER }}</td>
              </tr>
              @endforeach

            </tbody>
          </table>
          @else
          <table class="table table-hover table-stripped leadTable">
            <tbody class="body-table">
              <tr>
                <td>
                  No tiene referencias
                </td>
              </tr>
            </tbody>
          </table>
          @endif
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-10 col-md-10 col-lg-6">
      <div class="card mt-4">
        <div class="card-body table-responsive pt-1">
          <h4>Referencia Personal 2</h4>
          @if($references->isNotEmpty())
          <table class="table table-hover table-stripped leadTable">
            <thead class="header-table">
              <tr>
                <th class="text-center" scope="col">Nombre</th>
                <th class="text-center" scope="col">Dirección</th>
                <th class="text-center" scope="col">Barrio</th>
                <th class="text-center" scope="col">Celular</th>
                <th class="text-center" scope="col">Ciudad</th>
              </tr>
            </thead>
            <tbody class="body-table">
              @foreach ($references as $reference)

              <tr>
                <td class="text-center">{{ $reference->NOM_REFPE2 }}</td>
                <td class="text-center">{{ $reference->DIR_REFPE2 }}</td>
                <td class="text-center">{{ $reference->BAR_REFPE2 }}</td>
                <td class="text-center">{{ $reference->TEL_REFPE2 }}</td>
                <td class="text-center">{{ $reference->CIU_REFPE2 }}</td>
              </tr>
              @endforeach

            </tbody>
          </table>
          @else
          <table class="table table-hover table-stripped leadTable">
            <tbody class="body-table">
              <tr>
                <td>
                  No tiene referencias
                </td>
              </tr>
            </tbody>
          </table>
          @endif
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-10 col-md-10 col-lg-6">
      <div class="card mt-4">
        <div class="card-body table-responsive pt-1">
          <h4>Referencia Familiar 1</h4>
          @if($references->isNotEmpty())
          <table class="table table-hover table-stripped leadTable">
            <thead class="header-table">
              <tr>
                <th class="text-center" scope="col">Nombre</th>
                <th class="text-center" scope="col">Dirección</th>
                <th class="text-center" scope="col">Barrio</th>
                <th class="text-center" scope="col">Celular</th>
                <th class="text-center" scope="col">Ciudad</th>
              </tr>
            </thead>
            <tbody class="body-table">
              @foreach ($references as $reference)

              <tr>
                <td class="text-center">{{ $reference->NOM_REFFA2 }}</td>
                <td class="text-center">{{ $reference->DIR_REFFA2 }}</td>
                <td class="text-center">{{ $reference->BAR_REFFA2 }}</td>
                <td class="text-center">{{ $reference->TEL_REFFA2 }}</td>
                <td class="text-center">{{ $reference->CIU_REFFA2 }}</td>
              </tr>
              @endforeach

            </tbody>
          </table>
          @else
          <table class="table table-hover table-stripped leadTable">
            <tbody class="body-table">
              <tr>
                <td>
                  No tiene referencias
                </td>
              </tr>
            </tbody>
          </table>
          @endif
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-10 col-md-10 col-lg-6">
      <div class="card mt-4">
        <div class="card-body table-responsive pt-1">
          <h4>Referencia Familiar 2</h4>
          @if($references->isNotEmpty())
          <table class="table table-hover table-stripped leadTable">
            <thead class="header-table">
              <tr>
                <th class="text-center" scope="col">Nombre</th>
                <th class="text-center" scope="col">Dirección</th>
                <th class="text-center" scope="col">Barrio</th>
                <th class="text-center" scope="col">Celular</th>
                <th class="text-center" scope="col">Ciudad</th>

              </tr>
            </thead>
            <tbody class="body-table">
              @foreach ($references as $reference)

              <tr>
                <td class="text-center">{{ $reference->NOM_REFFAM}}</td>
                <td class="text-center">{{ $reference->DIR_REFFAM}}</td>
                <td class="text-center">{{ $reference->BAR_REFFAM }}</td>
                <td class="text-center">{{ $reference->TEL_REFFAM }}</td>
                <td class="text-center">{{ $reference->CIU_REFFAM }}</td>
              </tr>
              @endforeach

            </tbody>
          </table>
          @else
          <table class="table table-hover table-stripped leadTable">
            <tbody class="body-table">
              <tr>
                <td>
                  No tiene referencias
                </td>
              </tr>
            </tbody>
          </table>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
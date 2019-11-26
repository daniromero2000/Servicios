<div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
  <div class="box-body">
    <h2><i class="fa fa-user" aria-hidden="true"></i> Solicitud {{ $customer->SOLICITUD }} Sucursal {{ $customer->SUCURSAL }} {{ $customer->ESTADO }}
    </h2>
    <table class="table table-borderless table-hover table-sm">
      <thead>
        <tr>
          <th class="text-center" scope="col">Fecha de Solicitud</th>
          <th class="text-center" scope="col">Codeudores</th>
          <th class="text-center" scope="col">Asesor</th>
          <th class="text-center" scope="col">Gran Total</th>
          <th class="text-center" scope="col">Credito</th>
          <th class="text-center" scope="col">Avance</th>
          <th class="text-center" scope="col">Lead</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center">{{ $customer->FECHASOL }}</td>
          <td class="text-center">{{ $customer->CODEUDOR1 }}/{{ $customer->CODEUDOR2 }}/{{ $customer->CODEUDOR3 }}</td>
          <td class="text-center">{{ $customer->CODASESOR }}</td>
          <td class="text-center">{{ $customer->GRAN_TOTAL }}</td>
          <td class="text-center">{{ $customer->PRODUC_W }}</td>
          <td class="text-center">{{ $customer->AVANCE_W }}</td>

        </tr>
      </tbody>
    </table>

  </div>
</div>
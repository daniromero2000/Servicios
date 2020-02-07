<tbody class="body-table">
    <tr>
        <td class="text-center">
            {{ $data->NUMERO }}
        </td>
        <td class="text-center">
            {{ $data->SOLICITUD }}
        </td>
        <td class="text-center">
            $ {{  number_format ($data->CUP_INICIA) }}
        </td>
        <td class="text-center">
            $ {{  number_format ($data->CUP_COMPRA) }}
        </td>
        <td class="text-center">
            $ {{  number_format ($data->COMPRA_ACT) }}
        </td>
        <td class="text-center">
            $ {{  number_format ($data->CUPO_EFEC) }}
        </td>
        <td class="text-center">
            $ {{  number_format ($data->CUPO_ACTUAL) }}
        </td>
        <td class="text-center">
            $ {{  number_format ($data->CUPOMAX) }}
        </td>
        <td class="text-center">
            {{ $data->SUC }}
        </td>
        <td class="text-center">
            {{ $data->ESTADO }}
        </td>
        <td class="text-center">
            {{ $data->FEC_ACTIV }}
        </td>
        <td class="text-center">
            {{ $data->TIPO_TAR }}
        </td>
    </tr>
<tbody>
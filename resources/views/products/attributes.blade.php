@if(!$productAttributes->isEmpty())
<p class="alert alert-info">Solo puedes poner una Oferta por defecto</p>
<ul class="list-unstyled">
    <li>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center" scope="col">Codigo</th>
                    <th class="text-center"  scope="col">Cantidad</th>
                    <th class="text-center" scope="col">Precio</th>
                    <th class="text-center" scope="col">Precio Oferta</th>
                    <th class="text-center" scope="col">Atributos</th>
                    <th class="text-center" scope="col">Por defecto?</th>
                    <th class="text-center" scope="col">Quitar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productAttributes as $pa)
                <tr>
                    <td class="text-center">{{ $pa->id }}</td>
                    <td class="text-center">{{ $pa->quantity }}</td>
                    <td class="text-center">{{ $pa->price }}</td>
                    <td class="text-center">{{ $pa->sale_price }}</td>
                    <td class="text-center">
                        <ul class="list-unstyled">
                            @foreach($pa->attributesValues as $item)
                            <li>{{ $item->attribute->name }} : {{ $item->value }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-center">
                        @if($pa->default == 1)
                        <button class="btn btn-success"><i class="fa fa-check"></i></button> @else
                        <button class="btn btn-danger"><i class="fa fa-remove"></i></button> @endif
                    </td>
                    <td class="btn-group">
                        <a onclick="return confirm('¿Estás Seguro?')"
                            href="{{ route('admin.products.edit', [$product->id, 'combination' => 1, 'delete' => 1, 'pa' => $pa->id]) }}"
                            class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i> Borrar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </li>
</ul>
@else
<p class="alert alert-warning">No hay combinaciones aun.</p>
@endif
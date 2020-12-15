@if(!Empty($provinces))
<table class="table">
    <thead>
        <tr>
            <th class="text-center" class="col-md-4">Dane</th>
            <th class="text-center" class="col-md-4">Nombre</th>
        </tr>
    </thead>
    <tbody>
        @foreach($provinces as $province)
        <tr>
            <td class="text-center">
                {{ $province['dane'] }}
            </td>
            <td class="text-center"> <a
                    href="{{ route('admin.countries.provinces.show', [$country, $province['id']]) }}"></i>{{ $province['province'] }}</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
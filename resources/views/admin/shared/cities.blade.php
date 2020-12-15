<table class="table">
    <thead>
        <tr>
            <td class="text-center" class="col-md-4">Dane</td>
            <td class="text-center" class="col-md-4">Nombre</td>
        </tr>
    </thead>
    <tbody>
        @foreach($cities as $city)
        <tr>
            <td class="text-center">{{ $city['dane'] }}</td>
            <td class="text-center">{{ $city['city'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
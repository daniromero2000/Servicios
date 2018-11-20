@extends('layouts.app')

@section('title', 'Oportunidades Sevicios - Nuestras tiendas.')

@section('content')
	<div id="ourStores">
		<h1 class="menuItem-title text-center">Nuestras Tiendas</h1>
		<div class="container">
			<div class="row resetRow">
				<div class="col-12 col-sm-8 offset-sm-2">
					<div id="acorddion">
						@foreach($stores as $store)
							<div class="card">
								<div class="card-header" id="heading{{ $store['number'] }}">
									<h5 class="mb-0">
									<button class="btn btn-link ourStores-titleStore" data-toggle="collapse" data-target="#store{{ $store['number'] }}" aria-expanded="false" aria-controls="store{{ $store['number'] }}">
										{{ $store['name'] }}
									</button>
									</h5>
								</div>

								<div id="store{{ $store['number'] }}" class="collapse @if($store['number'] == 1) show @endif" aria-labelledby="heading{{ $store['number'] }}" data-parent="#acorddion">
									<div class="card-body">
										{{ $store['name'] }} <br>
										{{ $store['addres'] }} <br>
										{{ $store['city'] }} <br>
										{{ $store['telephone'] }}
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection()
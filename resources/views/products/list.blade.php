@extends('layouts.admin.app')
@section('content')
<!-- Main content -->
<section class="content">
    @include('layouts.errors-and-messages')
    <!-- Default box -->

    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <div class="box-body">
            <h1>Productos en Venta</h1>
            <div class="row">
                <div class="col-md-6">
                    @include('layouts.search', ['route' => route('admin.products.index')])
                </div>
            </div>
            @if(!$products->isEmpty())
            @include('admin.shared.products') {{ $products->links()
            }}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    @endif

</section>
<!-- /.content -->
@endsection
@extends('layouts.admin.app')
@section('linkStyleSheets')
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
<link rel="stylesheet" href="{{asset('css/admin/main.css')}}">

@endsection
@section('content')
<section class="content">
    @include('layouts.errors-and-messages')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Productos</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(!is_null($products))
                            <div class=" table-responsive p-0 height-table">

                                <table class="table text-center table-hover table-head-fixed">
                                    <thead class="header-table">
                                        <tr>
                                            <th scope="col">Código</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Marca</th>
                                            <th scope="col">Descuento</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="body-table">
                                        @if ($products)
                                        @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->sku }}</td>
                                            <td> {{ $product->name }} </td>
                                            <td>{{ $product->brand_id->name }}</td>
                                            <td>{{ number_format($product->discount, 0, '.', ',') }}%</td>
                                            <td>
                                                @if ($product->status == 1)
                                                <span class="badge badge-success">Activo</span>
                                                @else
                                                <span class="badge badge-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <i class="fas fa-trash-alt cursor" data-toggle="modal"
                                                    data-target="#deleteProduct{{ $product->id }}">
                                                </i>
                                                <i class="fas fa-edit cursor" onclick="idproduct({{$product->id}})"
                                                    data-toggle="modal"
                                                    data-target="#updateProduct{{ $product->id }}"></i>
                                                <i class="fas fa-eye cursor" data-toggle="modal"
                                                    data-target="#showProduct{{ $product->id }}"></i>
                                            </td>
                                        </tr>

                                        @include('products.layouts.modals.modal_update_product')

                                        @include('products.layouts.modals.modal_delete_product')
                                        @include('products.layouts.modals.modal_show_product')

                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @endif
                            </div>
                            <div class="text-right mt-2">
                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#addProduct">Agregar
                                    Producto</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Marcas</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(!is_null($brands))
                            <div class=" table-responsive p-0 height-table">

                                <table class="table text-center table-hover table-head-fixed">
                                    <thead class="header-table">
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="body-table">
                                        @if ($brands)
                                        @foreach ($brands as $brand)

                                        <tr>
                                            <td>
                                                {{ $brand->name }}</a>
                                            </td>
                                            <td>
                                                <i class="fas fa-trash-alt cursor" data-toggle="modal"
                                                    data-target="#deletebrand{{ $brand->id }}"></i>
                                                <i class="fas fa-edit cursor" data-toggle="modal"
                                                    data-target="#updatebrand{{ $brand->id }}"></i>
                                            </td>
                                        </tr>
                                        <div>
                                            <div>
                                                @include('products.layouts.modals.modal_update_brand')
                                            </div>
                                            @include('products.layouts.modals.modal_delete_brand')

                                        </div>
                                        @endforeach
                                        @endif


                                    </tbody>
                                </table>
                            </div>

                            @else

                            <p class="alert alert-warning">No hay marcas creadas aun. <a
                                    href="{{ route('brands.create') }}">Crea una!</a></p>
                            @endif
                            <div class="text-right mt-2">
                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#addbrand">Agregar Marca</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        @include('products.layouts.modals.modal_create_brand')

    </div>
    <div>

        @include('products.layouts.modals.modal_create_product')
    </div>

</section>
@endsection
@section('scriptsJs')
<!-- bs-custom-file-input -->
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('js/admin/products/app.js')}}"></script>
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
</script>
<script type="text/javascript">
    $( document ).ready(function() {
    $("[rel='tooltip']").tooltip();

    $('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    );
});
</script>
<script type="text/javascript">
    !function(window){
  var $q = function(q, res){
        if (document.querySelectorAll) {
          res = document.querySelectorAll(q);
        } else {
          var d=document
            , a=d.styleSheets[0] || d.createStyleSheet();
          a.addRule(q,'f:b');
          for(var l=d.all,b=0,c=[],f=l.length;b<f;b++)
            l[b].currentStyle.f && c.push(l[b]);

          a.removeRule(0);
          res = c;
        }
        return res;
      }
    , addEventListener = function(evt, fn){
        window.addEventListener
          ? this.addEventListener(evt, fn, false)
          : (window.attachEvent)
            ? this.attachEvent('on' + evt, fn)
            : this['on' + evt] = fn;
      }
    , _has = function(obj, key) {
        return Object.prototype.hasOwnProperty.call(obj, key);
      }
    ;

  function loadImage (el, fn) {
    var img = new Image()
      , src = el.getAttribute('data-src');
    img.onload = function() {
      if (!! el.parent)
        el.parent.replaceChild(img, el)
      else
        el.src = src;

      fn? fn() : null;
    }
    img.src = src;
  }

  function elementInViewport(el) {
    var rect = el.getBoundingClientRect()

    return (
       rect.top    >= 0
    && rect.left   >= 0
    && rect.top <= (window.innerHeight || document.documentElement.clientHeight)
    )
  }

    var images = new Array()
      , query = $q('img.lazy')
      , processScroll = function(){
          for (var i = 0; i < images.length; i++) {
            if (elementInViewport(images[i])) {
              loadImage(images[i], function () {
                images.splice(i, i);
              });
            }
          };
        }
      ;
    // Array.prototype.slice.call is not callable under our lovely IE8 
    for (var i = 0; i < query.length; i++) {
      images.push(query[i]);
    };

<<<<<<< HEAD
    // processScroll();
    addEventListener('click',processScroll);
=======
    processScroll();
    addEventListener('scroll',processScroll);
>>>>>>> release-sentings

}(this);
</script>
@endsection
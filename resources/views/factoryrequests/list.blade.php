@extends('layouts.admin.app')
@section('content')

<section class="content">
    @include('layouts.errors-and-messages')

    @if(!is_null($customers))
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <div class="box-body">
            <h1>Solicitudes</h1>
            <div class="row">
                <div class="col-md-5">

                </div>
                <div class="col-md-5 float-right">

                </div>
            </div>
            @if($customers)
            @include('layouts.admin.tables.tables_lead_status', [$headers, 'datas' => $customers ])
            @include('layouts.admin.pagination.pagination', [$skip])
            @else
            @include('layouts.admin.pagination.pagination_null', [$skip])
            @endif
            </tbody>
            </table>
        </div>
    </div>
    @endif
</section>
@endsection
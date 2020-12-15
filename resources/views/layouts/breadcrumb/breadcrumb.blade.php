   <div class="header pb-2">
       <div class="container-fluid">
           <div class="header-body">
               <div class="row align-items-center py-4">
                   <div class="col-lg-6 col-7">
                       <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                           <ol class="breadcrumb breadcrumb-links">
                               <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                               @foreach ($data as $item)
                                   <li class="breadcrumb-item {{ $item['status'] }}"><a
                                           href="{{ $item['route'] != '' ? route($item['route']) : '' }}">{{ $item['name'] }}</a>
                                   </li>
                               @endforeach
                           </ol>
                       </nav>
                   </div>
               </div>
           </div>
       </div>
   </div>

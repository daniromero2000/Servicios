@extends('layouts.app')
 
@section('content')

    <div class="containerPages">   
        <div class="row">
            <a href="{{ route('pages.create') }}" class="btn btn-success pull-right">Create Page</a>
        </div>
        <br>
        @if (Session::get('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
     
        <div class="table table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        
                        <th style="width: 25%;">name</th>
                        <th style="width: 50%;">Description</th>
                        <th style="width: 25%;">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $key => $page)
                    <tr>
                        
                       
                        <td style="width: 25%;">{{ $page->name }}</td>
                        <td style="width: 50%;">{{ $page->description }}</td>
                        <td style="width: 25%">
                            <a href="{{ route('pages.show', $page->id) }}" class="btn btn-success" ><i class="fa fa-eye"></i></a><br>
                            <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-info" ><i class="fa fa-pencil-square-o"></i></a>
     
                            <form action="{{ route('pages.destroy', $page->id) }}" method="POST" >
                                @method('DELETE')
                                @csrf 
                                <button type="submit" class="btn btn-danger" value="Delete"> <i class="fa fa-trash-o"></i>  </button>                           
                               
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $pages->links() !!}
     
        </div>
    </div>
@stop
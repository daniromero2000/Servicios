@extends('layouts.app')
 
@section('content')
    <h2> Create new Page </h2>
    <hr>
 
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('pages.store') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Page name</label>
            <input type="text" name="name" class="form-control" placeholder="Page name">
        </div>
        <div class="form-group">
            <label>Page Description</label>
            <textarea name="description" rows="4" class="form-control"></textarea>
        </div>
        <a href="{{ route('pages.index') }}" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
 
@stop
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Categorías</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if($errors->any())
        <div class="alert alert-warning">{{$errors->first()}}</div>
    @endif
    <div class="row">
        <div class="container">
            <div class="row justify-content-center">
                @foreach($categories as $category)
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header"><a href="{{ route('category-detail', ['id'=>$category->id]) }}">{{ $category->name }}</a></div>
                            <div class="card-body">{{ $category->detail }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Usuarios de Reqres</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @can('role-list')
    <div class="row">
        <div class="container">
            <div class="row justify-content-center">
                @foreach($users as $user)
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ $user->id }}: {{ $user->first_name }} {{ $user->last_name }} - {{ $user->email }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <div class="row justify-content-center">
                @for ($i = 1 ; $i <= $total_pages; $i++)
                    @if($page == $i)
                        <a class="btn btn-info disabled" href="#">{{$i}}</a>&nbsp;
                    @else
                        <a class="btn btn-info" href="{{route('users-list-page', ['page'=>$i])}}">{{$i}}</a>&nbsp;
                    @endif
                @endfor
            </div>
        </div>
    </div>
    @endcan
    @cannot('role-list')
        <div class="row">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="alert alert-danger">No tienes permisos para ver esta sección</div>
                </div>
            </div>
        </div>
    @endcannot
@endsection

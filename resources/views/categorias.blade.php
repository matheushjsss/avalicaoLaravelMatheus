@extends('layouts.app') <!-- Assume que você está usando um layout principal -->

@section('content')
    <div>
       Ola @auth
       {{ auth()->user()->name }}
       @endauth
    </div>

    <div>
        <h1>categorias</h1>
    </div> 
@endsection
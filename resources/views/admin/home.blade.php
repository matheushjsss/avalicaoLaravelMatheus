@extends('layouts.admin') <!-- Assume que você está usando um layout principal -->

@section('content')
    <div>
       Ola @auth
       {{ auth()->user()->name }}
       @endauth
    </div>

    <div>
        <h1>Home Page</h1>
    </div> 
@endsection
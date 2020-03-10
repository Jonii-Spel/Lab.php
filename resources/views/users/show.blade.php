@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')
    
   <h1>Usuario #{{ $user->id }} </h1>
            
    Nombre y apellido: {{$user->name}} <br>

    Correo electronico: {{ $user->email }}

    <p>
        {{-- <a href="{{ url('/usuarios') }}">Regresar (url)</a><br>
        <a href="{{ action('UserController@index') }}">Regresar (action)</a><br> --}}
         <a href="{{ route('users') }}">Regresar</a>
    </p>

@endsection


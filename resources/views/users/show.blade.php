@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')
    
   <h1>Usuario #{{ $user->id }} </h1>
            
    Nombre y apellido: {{$user->name}} <br>

    Correo electronico: {{ $user->email }}

@endsection


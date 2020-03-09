@extends('layout')

@section('title', 'Usuario')

@section('content')

<div class="jumbotron">

    <h1>{{ $title }}</h1>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th colspan="3">Acciones</th>
          </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
          <tr>
            
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td><a href="{{route('userID', $user->id)}}">Detalles</a></td>
            <td><a href="{{route('users.edit', $user->id)}}">Modificar</a></td>
            <td><a href="">Eliminar</a></td>
          </tr>
          @endforeach
        </tbody>
    </table>

</div>

@endsection


@section('sidebar')

@endsection
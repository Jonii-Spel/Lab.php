@extends('layout')

@section('title', 'Usuario')

@section('content')

<div class="jumbotron">

  <div class="text-center">
    <h1>{{ $title }}</h1><br>
  </div>  

 
    <a class="btn btn-primary btn-lg btn-block" href="{{route('userNew')}}">| Nuevo |</span></a>
    
    
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Nombre y Apellido</th>
            <th scope="col">Email</th>
            <th colspan="3">Acciones</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($users as $user)

          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td><a href="{{route('userID', $user->id)}}"> <span class="oi oi-eye"></span></a></td> 
            <td><a href="{{route('users.edit', $user->id)}}"><span class="oi oi-pencil"></span></a></td> 
            <td><a onclick="preguntar({{$user->id }})" ><span style="color: red" class="oi oi-trash" ></span></a></td>            
          </tr>

          @endforeach
        </tbody>
    </table>
    <div>
      <script type="text/javascript">
      function preguntar($userid) {    
        var r = confirm('Estas seguro que deseas eliminarlo ? ');

        if (r == true) {
          window.location.href = "/usuarios/"+$userid+"/delete";
        }
      }
      </script>
    </div>

</div> 

@endsection

@section('sidebar')

@endsection
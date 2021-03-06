@extends('layout')

@section('title', "Crear Usuario")

@section('content')

   {{-- @if ($errors->any())
   <div class="form-group row alert alert-danger">
     <h5>Por favor corrige los errores:</h5>
      <ul>
        @foreach ($errors->all() as $error)
          <li> {{ $error }} </li>
        @endforeach
    </ul> 
  </div>
   @endif --}}
         
   
   <div class="card text-center">
    <h1 class="card-header">Crear Usuario</h1>
    <div class="card-body">

      <form action="{{ url('/usuarios') }}" method="POST">
        {{ csrf_field() }}


        <div class="form-group {{ $errors->has('name')? 'alert alert-danger' : '' }}">
            <label for="name">Nombre y apellido:</label>
            <input type="text" class="form-control" name="name" placeholder="name and surname" id="name" value="{{old('name')}}">

            {{ $errors->has('name') ? $errors->first('name') : '' }}
          </div>

        <div class="form-group {{ $errors->has('email')? 'alert alert-danger' : '' }}">
            <label for="email">Email:</label>
          <input class="form-control" name="email" placeholder="example@hotmail.com" id="email" value="{{old('email')}}">

          {{ $errors->has('email') ? $errors->first('email') : '' }}    
          </div>

          <div class="form-group {{ $errors->has('password')? 'alert alert-danger' : '' }}">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" placeholder="*****" id="password">
           
            {{ $errors->has('password') ? $errors->first('password') : '' }}
          </div>

          <div>
            <button class="btn btn-outline-secondary" type="submit">New User</button>
          </div>
        
    </form>

    <p>
        <br><a href="{{ url('/usuarios') }}">Regresar</a>
        {{-- <a href="{{ action('UserController@index') }}">Regresar (action)</a><br>
        <a href="{{ route('users') }}">Regresar (route)</a> --}}
    </p>

    </div>
  </div>
    

@endsection


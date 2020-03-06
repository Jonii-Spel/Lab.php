<?php



Route::get('/', 'UserController@index');



Route::get('/usuarios', 'UserController@index')
    ->name('users');

Route::get('/usuarios/{user}', 'UserController@show')
    ->where('user','[0-99]+')
    ->name('userID') ;


Route::get('usuarios/nuevo', 'UserController@create')
    ->name('userNew');

Route::post('/usuarios', 'UserController@store');


Route::get('/usuarios/edit/{id}', 'UserController@edit')
    ->name('userEdit');

Route::get('/saludo/{name}/{nickname?}', 'WelcomeUserController');



/*  alias t=vendor/bin/phpunit

Route::get('/', function () {
    $nombre = "Jorge";


    return view('tutoriales.home', compact('nombre')); // ->with('nombre', $nombre);
                                // ['nombre'] => $nombre
})-> name('home');

*/
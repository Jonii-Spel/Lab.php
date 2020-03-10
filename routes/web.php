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


Route::get('/usuarios/{user}/editar', 'UserController@edit')
    ->name('users.edit');

Route::put('usuarios/{user}', 'UserController@update');

Route::get('/usuarios/{user}/delete', 'UserController@destroy')
    ->name('user.delete');



Route::get('/saludo/{name}/{nickname?}', 'WelcomeUserController');



/*  alias t=vendor/bin/phpunit

Route::get('/', function () {
    $nombre = "Jorge";


    return view('tutoriales.home', compact('nombre')); // ->with('nombre', $nombre);
                                // ['nombre'] => $nombre
})-> name('home');

*/
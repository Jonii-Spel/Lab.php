<?php



Route::get('/', 'UserController@index');



Route::get('/usuarios', 'UserController@index')->name('users');

Route::get('/usuarios/{id}', 'UserController@show')
    ->where('id','[0-99]+')->name('userID') ;

Route::get('usuarios/nuevo', 'UserController@create');

Route::get('usuarios/edit/{id}', 'UserController@edit');

Route::get('/saludo/{name}/{nickname?}', 'WelcomeUserController');



/*  alias t=vendor/bin/phpunit

Route::get('/', function () {
    $nombre = "Jorge";


    return view('tutoriales.home', compact('nombre')); // ->with('nombre', $nombre);
                                // ['nombre'] => $nombre
})-> name('home');

*/
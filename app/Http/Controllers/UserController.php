<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {

        $users = User::all();
        // DB::table('users')->get();

        // dd($users);

        $title = 'Listado de usuarios';


        // return view('users.index')
        // ->with('users', User::all())
        // ->with('title', 'Listado de Usuarios');
        return view('users.index', compact('title', 'users'));

    }

    public function show($id)
    {
        $user = User::find($id);

        // dd($user);

        return view('users.show', compact('user'));

    }

    public function create()
    {
        return "Crear nuevo user";
    }

    public function edit($id)
    {
        return "Aca editamos al user: {$id}";
    }
}

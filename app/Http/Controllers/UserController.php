<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function show(User $user)
    {
        // $user = User::findOrFail($id);

        // if ($user == null) {
        //     return response()->view('errors.404', [], 404);
        // }

         //dd($user);

        return view('users.show', compact('user'));

    }

    public function create()
    {
        return view('users\create');
    }

    public function store()
    {
        //return redirect('usuarios/nuevo')->withInput();

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'Por favor, ingrese un email valido',
            'password.required' => 'El campo password es obligatorio',
            'password.min' => 'El campo password necesita 6 caracteres como minimo'
        ]);

        // if (empty($data['name'])) {
        //     return redirect('usuarios/nuevo')->withErrors([
        //         'name' => 'El campo nombre es obligatorio'
        //     ]);
        // }

        // dd($data);  

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])

            // Hash::make();

        ]);

        return redirect()->route('users');
    }

    public function edit(User $user)
    {
       return view('users.edit', ['user' => $user]);
    }


    public function update(User $user)
    {

        //dd('Actualizar usuario');

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. $user->id,
            'password' => 'nullable|min:6'
        ]);

        if ($data['password'] != null) {
            $data['password'] =Hash::make($data['password']);
        }else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('userID', ['user' => $user]);

    }

    function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users');
    }
}

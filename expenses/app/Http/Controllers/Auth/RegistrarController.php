<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegistrarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index()
    {
        return view('auth.registrar');
    }

    public function store(Request $request)
    {
        //validação
        $this->validate($request, [
            'name' => ['required', 'max:255'],
            'username' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:4','confirmed']
        ]);

        //armazenar no banco de dados
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //entrar
        auth()->attempt($request->only('email', 'password'));
        
        //redirecionar
        return redirect()->route('despesas');
    }
}

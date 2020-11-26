<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntrarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.entrar');
    }

    public function store(Request $request)
    {
        //validação
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        
        //Entrar
        if(!auth()->attempt($request->only('email', 'password'), $request->remember))
        {
            return back()->with('status', 'Credenciais de login inválidas');
        }

        return redirect()->route('despesas');
    }
}

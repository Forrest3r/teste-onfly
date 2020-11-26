<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use Illuminate\Http\File;
use Illuminate\Http\Request;

class DespesasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {    
        $despesas = Despesa::get();
        return view('despesas.index', [
            'despesas' => $despesas
        ]);
    }

    public function show(Despesa $despesa)
    {
        return view('despesas.ver',[
            'despesa' => $despesa
        ]);
    }

    public function create()
    {
        return view('despesas.nova');
    }

    public function edit(Despesa $despesa)
    {
        return view('despesas.editar',[
            'despesa' => $despesa
        ]);
    }

    public function update(Request $request, $id)
    {
        //validação
        $this->validate($request, [
            'title' => ['required', 'between:1,255'],
            'description' => ['required', 'between:1,65.535'],
            'date' => ['required'],
            'value' => ['required', 'numeric'],
            'receipt' => ['required'],
        ]);

        $despesa = Despesa::findOrFail($id);
            
        //armazenar no bando de dados
        $despesa->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'value' => $request->value,
            'receipt' => request('receipt')->store('receipts'),
        ]);

        return redirect()->route('despesas');
    }

    public function store(Request $request)
    {
        //validação
        $this->validate($request, [
            'title' => ['required', 'between:1,255'],
            'description' => ['required', 'between:1,65.535'],
            'date' => ['required'],
            'value' => ['required', 'numeric'],
            'receipt' => ['required', 'file', 'max:8000'],
        ]);

        //armazenar no bando de dados
        $request->user()->despesas()->create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'value' => $request->value,
            'receipt' => request('receipt')->store('receipts'),
        ]);
        
        //redirecionar
        return redirect()->route('despesas');
    }

    public function destroy(Despesa $despesa)
    {
        $despesa->delete();
        return redirect()->route('despesas');
    }
}

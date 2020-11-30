<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use NumberFormatter;
use App\Models\Despesa;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DespesasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {    
        $despesas = Despesa::where('user_id', auth()->user()->id)->latest('date')->get();
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
            'value' => ['required'],
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
            'value' => ['required'],
            'receipt' => ['required', 'file', 'max:8000'],
        ]);

        //Converter formatos
        $convertedDate = Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d');
        //$convertedValue = NumberFormatter::parseCurrency($request->value, 'pt_B');
        //$numberFormatter = new NumberFormatter('pt-BR',NumberFormatter::CURRENCY);
        //$format = 'pt_b';
        //$convertedValue = numfmt_parse_currency ($numberFormatter , $request->value , $format);
        $convertedValue = str_replace(".", "", $request->value);
        $convertedValue = floatval(str_replace(",", ".", $convertedValue));

        //armazenar no bando de dados
        $request->user()->despesas()->create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $convertedDate,
            'value' => $convertedValue,
            'receipt' => request('receipt')->store('receipts'),
        ]);
        
        //redirecionar
        return redirect()->route('despesas');
    }

    public function destroy(Despesa $despesa)
    {
        Storage::delete($despesa->receipt);
        $despesa->delete();
        return redirect()->route('despesas');
    }
}

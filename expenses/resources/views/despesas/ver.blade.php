@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        @if($despesa->user_id === auth()->id())

            <div class="w-8/12 bg-white p-6 rounded-lg">

                <div class="flex justify-between mb-5 text-lg">
                    <span class="font-bold">{{$despesa->title}}</span>
                    <span class="text-gray-600">{{\Carbon\Carbon::parse($despesa->date)->format('d/m/Y')}}</span>
                </div>

                <p class="mb-4">{{$despesa->description}}</p>
                <p class="text-red-400 mb-6">R${{number_format($despesa->value, 2, ',', '.')}}</p>

                <p class="text-lg flex justify-center">Nota fiscal:</p>

                <img src="{{asset($despesa->receipt)}}" alt="Nota Fiscal" class="w-8/12
                flex justify-center">
                
                <div class="flex justify-between">

                    <form action="{{route('deletar.despesa', $despesa)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Deletar</button>
                    </form>

                    <a href="{{route('editar.despesa', $despesa)}}" class="text-blue-800">Editar</a>

                </div>

            </div>
       @else
            <p class="text-lg text-red-500 mt-4">Despesa Inválida!</p>
       @endif
    </div>
@endsection
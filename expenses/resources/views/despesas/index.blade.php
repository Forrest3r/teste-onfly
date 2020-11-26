 @extends('layouts.app')

 @section('content')
     <div class="flex justify-center">

        <div class="w-8/12 bg-white p-6 rounded-lg">

            <form action="{{route('nova.despesa')}}" method="GET" class="flex justify-center mb-4">
                <button type="submit" class="bg-blue-400 text-white px-4 py-2 rounded font-medium">
                    Nova despesa
                </button>
            </form>
    
            @if($despesas->count())
                @foreach ($despesas as $despesa)

                    @if($despesa->user_id === auth()->id())

                        <div class="mb-4 p-4 border-2 w-full ">

                            <div class="flex justify-between">

                                <span class="font-bold mb-2">{{$despesa->title}}</span>
                                <span class="text-gray-600 text-sm mb-2">{{$despesa->date}}</span>
                            </div>

                            <p class="text-red-400 text-sm mb-2">R${{$despesa->value}}</p>

                            <div class="flex justify-between">

                                <form action="{{route('deletar.despesa', $despesa)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Deletar</button>
                                </form>

                                <form action="{{route('ver.despesa', $despesa)}}" method="get">
                                    @csrf
                                    <button type="submit" class="text-blue-800">+ detalhes</button>
                                </form>

                            </div>


                        </div>
                    @endif

                @endforeach

            @else
                <p class="mt-4">Não há despesas.</p>
            @endif

        </div>

     </div>
 @endsection
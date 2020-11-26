@extends('layouts.app')

@section('content')
    <div class="flex justify-center">

       <div class="w-8/12 bg-white p-6 rounded-lg">

           <form action="{{route('nova.despesa')}}" method="post" enctype="multipart/form-data">
               @csrf

               <div class="mb-4">
                   <label for="title" class="sr-only">Título</label>
                   <input type="text" name="title" id="title" placeholder="Título"
                   class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name')
                   border-red-500 @enderror" value="{{ old('title') }}" autocomplete="off">

                   @error('title')
                       <div class="text-red-500 mt-2 text-sm">
                           {{$message}}
                       </div>
                   @enderror
               </div>

               <div class="mb-4">
                   <label for="description" class="sr-only">Nome</label>
                   <textarea name="description" id="description" cols="30" rows="4" class="bg-gray-100
                   border-2 w-full p-4 rounded-lg @error('description') border-red-500 @enderror"
               placeholder="Descrição" value="{{old('description')}}"></textarea>

                   @error('description')
                       <div class="text-red-500 mt-2 text-sm">
                           {{$message}}
                       </div>
                   @enderror
               </div>

               <div class="mb-4">
                   <label for="date" class="sr-only">Data</label>
                   <input type="date" name="date" id="date" placeholder="Data"
                   class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('date')
                   border-red-500 @enderror" value="{{ old('date') }}" autocomplete="off">

                   @error('date')
                       <div class="text-red-500 mt-2 text-sm">
                           {{$message}}
                       </div>
                   @enderror
               </div>

               <div class="mb-4">
                   <label for="value" class="sr-only">Valor</label>
                   <input type="number" name="value" id="value" placeholder="Valor"
                   class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('value')
                   border-red-500 @enderror" value="{{ old('value') }}" step="0.01" autocomplete="off">

                   @error('date')
                       <div class="text-red-500 mt-2 text-sm">
                           {{$message}}
                       </div>
                   @enderror
               </div>

               <div class="mb-4">
                   <p class="mt-4 mb-2 text-md text-gray-400">Nota Fiscal</p>

                   <label for="receipt" class="sr-only">Nota Fiscal</label>
                   <input type="file" name="receipt" id="receipt" placeholder="Imagem"
                   class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('receipt')
                   border-red-500 @enderror" value="{{ old('receipt') }}" autocomplete="off">

                   @error('receipt')
                       <div class="text-red-500 mt-2 text-sm">
                           {{$message}}
                       </div>
                   @enderror
               </div>

               <div>
                   <button type="submit" class="bg-blue-400 text-white px-4 py-2 rounded font-medium">
                       Enviar
                   </button>
               </div>

           </form>
       </div>

    </div>
@endsection
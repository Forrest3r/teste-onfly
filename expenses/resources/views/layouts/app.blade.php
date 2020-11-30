<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Controle de Despesas</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <script type="text/javascript" src="{{asset('js/jquery-3.5.1.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.mask.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery-ui.min.js')}}"></script>
    <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">

</head>
<body class="bg-gray-200">

    <nav class="p-6 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
            <li>
            <a class="p-3" href="{{route('home')}}">Home</a>
            </li>

            <li>
            <a class="p-3" href="{{route('despesas')}}">Despesas</a>
            </li>
        </ul>

        <ul class="flex items-center">

            @auth
                <li>
                <a class="p-3" href="#">{{ auth()->user()->name }}</a>
                </li>

                <li>
                    <form action="{{route('sair')}}" method="post" class=" p-3 inline">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            @endauth

            @guest
                <li>
                    <a class="p-3" href="{{ route('entrar') }}">Entrar</a>
                </li>

                <li>
                <a class="p-3" href="{{ route('registrar') }}">Registrar-se</a>
                </li>
            @endguest

        </ul>
    </nav>

    @yield('content')
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>@yield("title", "Exon - Apontamento de Materiais")</title>
	<link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    @stack('styles')
</head>
<body>
    <header>
        <div class="logo">
            <img class="logo" src="{{ asset("assets/img/exon_logo.png") }}" draggable="false" alt="Exon">
        </div>
        <nav>
            <a href="{{ route("produtos.index") }}">Produtos</a>
            <a href="{{ route("estruturas.index") }}">Estruturas</a>
            <a href="{{ route("relatorios.index") }}">Relatorios</a>
        </nav>
    </header>
	<main>
        <div class="content">
            @yield('content')
        </div>
	</main>
</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(".logo").click( function () {
        window.location = "{{ route("produtos.index") }}";
    });
</script>

@yield('script')


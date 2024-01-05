@extends('layout')

@section('title', 'Relatório de Matéria Prima')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/relatorio/index.css') }}">
@endpush

@section('content')
    <h1>Relatório de Matéria Prima</h1>

    <form method="post" action="{{ route('relatorios.gerar') }}">
        @csrf
        <label for="codigo_produto">Digite o Código do Produto:</label>
        <input type="text" name="codigo_produto" id="codigo_produto" required>
        <button type="submit">Gerar Relatório</button>
    </form>

    @if(isset($produto))
        <h2>Relatório para o Produto: {{ $produto->codigo_produto }}</h2>

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Quantidade Total</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materiaPrima as $item)
                    <tr>
                        <td>{{ $item['codigo_produto'] }}</td>
                        <td>{{ $item['descricao'] }}</td>
                        <td>{{ $item['quantidade'] }}</td>
                        <td>{{ $item['valor_total'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection

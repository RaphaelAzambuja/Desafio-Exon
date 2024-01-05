@extends('layout')

@section('title', isset($produto) ? 'Exon - Editar Produto' : 'Exon - Criar Produto')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/produtos/create.css') }}">
@endpush

@section('title', isset($produto) ? 'Editar Produto' : 'Criar Novo Produto')

@section('content')
    <h1>{{ isset($produto) ? 'Editar Produto' : 'Criar Novo Produto' }}</h1>

    @if (isset($produto))
        <form action="{{ route('produtos.update', $produto->codigo_produto) }}" method="post">
            @method('PUT')
    @else
        <form action="{{ route('produtos.store') }}" method="post">
    @endif
        @csrf

        @if (!isset($produto))
            <label for="codigo_produto">Código do Produto:</label>
            <input type="text" id="codigo_produto" name="codigo_produto" value="{{ old('codigo_produto', isset($produto) ? $produto->codigo_produto : '') }}" required>
        @else
            <input type="hidden" name="codigo_produto" value="{{ $produto->codigo_produto }}">
        @endif

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" value="{{ old('descricao', isset($produto) ? $produto->descricao : '') }}" required>

        <label for="custo_unitario">Custo Unitário:</label>
        <input type="number" id="custo_unitario" name="custo_unitario" step="0.01" value="{{ old('custo_unitario', isset($produto) ? $produto->custo_unitario : '') }}" required>

        <div class="buttons">
            <button class="button-success" type="submit">{{ isset($produto) ? 'Atualizar' : 'Criar' }}</button>
        </form>
            <form action="{{ route("produtos.index") }}"><button class="button-danger">Cancelar</button></form>
        </div>
@endsection

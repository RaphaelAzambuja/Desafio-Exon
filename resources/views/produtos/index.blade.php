@extends('layout')

@section('title', 'Exon - Lista de Produtos')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/produtos/index.css') }}">
@endpush

@section('content')
<div class="title">

    <h1>Lista de Produtos</h1>
    <a href="{{ route('produtos.create') }}">Novo Produto</a>

    <div class="filters">
        <input type="text" id="filtro" placeholder="Filtrar por Código ou Descrição" class="filter-input">
        <button id="pesquisar">pesquisar</button>
    </div>
</div>

<div class="message-container">
    <!-- Aqui será exibida uma mensagem caso não exista produtos cadastrados -->
</div>

<div class="table">
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Descrição</th>
                <th>Custo Unitário (UN)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
            <tr>
                <td>{{ $produto->codigo_produto }}</td>
                <td>{{ $produto->descricao }}</td>
                <td>{{ $produto->custo_unitario }}</td>
                <td>
                    <form action="{{ route('produtos.edit', $produto->codigo_produto) }}"> <button class="button-warning" type="submit">Editar</button> </form>
                    <form action="{{ route('produtos.destroy', $produto->codigo_produto) }}" method="post" onsubmit="return confirm('Você tem certeza que deseja excluir este produto?')">
                        @csrf
                        @method('DELETE')
                        <button class="button-danger" type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
<script>
$(document).ready(function ()
{
    function showNoProductsMessage()
    {
        const tbodyLength = $("tbody tr").length;
        const messageContainer = $(".message-container");
        const tableContainer = $(".table");

        if (tbodyLength === 0)
        {
            messageContainer.show();
            tableContainer.hide();

            messageContainer.empty();
            const message = $("<h2>").text("Nenhum produto encontrado.");
            messageContainer.append(message);
        }
        else
        {
            messageContainer.hide();
            tableContainer.show();
        }
    }

    function pesquisar()
    {
        const filtro = $("#filtro").val().toUpperCase();

        $.ajax({
            url: "{{ route('produtos.index') }}",
            method: "GET",
            dataType: "json",
            success: function (data)
            {
                $("tbody").empty();

                $.each(data, function (index, produto)
                {
                    if (produto.codigo_produto.toUpperCase().includes(filtro) || produto.descricao.toUpperCase().includes(filtro))
                    {
                        const row = $("<tr>").append(
                            $("<td>").text(produto.codigo_produto),
                            $("<td>").text(produto.descricao),
                            $("<td>").text(produto.custo_unitario),
                            $("<td>").html(
                                '<form action="{{ url('produtos') }}/' + produto.codigo_produto + '/edit"><button class="button-warning" type="submit">Editar</button></form>' +
                                '<form action="{{ url('produtos') }}/' + produto.codigo_produto + '" method="post" onsubmit="return confirm(\'Você tem certeza que deseja excluir este produto?\')">' +
                                '@csrf' +
                                '@method("DELETE")' +
                                '<button class="button-danger" type="submit">Excluir</button>' +
                                '</form>'
                            )
                        );

                        $("tbody").append(row);
                    }
                });

                showNoProductsMessage();
            },
            error: function (error)
            {
                console.log("Erro na requisição AJAX: ", error);
            }
        });
    }

    showNoProductsMessage();

    $("#pesquisar").on("click", pesquisar);

    $("#filtro").on("keypress", function (event)
    {
        if (event.which === 13)
        {
            pesquisar();
        }
    });
});

</script>
@endsection

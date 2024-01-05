@extends('layout')

@section('title', 'Exon - Criar Estrutura')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/estruturas/index.css') }}">
@endpush

@section('content')
    <div class="container">

        <h1>Cadastro de Estruturas</h1>

        <form id="add-product-form">
            @csrf
            <label for="codigo_produto_pai">Código do Produto Pai:</label>
            <input type="text" name="codigo_produto_pai" id="codigo_produto_pai" placeholder="Código do Produto Pai">

            <button type="button" onclick="loadStructure()">Carregar Estrutura</button>
        </form>

        <form id="add-new-product-form">
            @csrf
            <label for="codigo_produto_filho">Código do Produto Filho:</label>
            <input type="text" name="codigo_produto_filho" id="codigo_produto_filho" placeholder="Código do Produto Filho">

            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" min="1" required>

            <button type="button" onclick="addProduct()">Adicionar Produto</button>
        </form>

        <div id="treeview-container">
            <!-- a treeview fica aqui aqui -->
        </div>

    </div>

@endsection

@section('script')
<script>

    function renderTreeView(data)
    {
        const $treeview = $('#treeview-container');
        $treeview.empty();
        $treeview.show();
        renderNode(data, $treeview);
    }

    function renderNode(node, $parent)
    {
        console.log('Rendering node:', node);

        if (Array.isArray(node))
        {
            node.forEach(function (child)
            {
                renderNode(child, $parent);
            });
        }
        else
        {
            const $li = $('<li>').appendTo($parent);
            const $span = $('<span>').addClass('item').text(node.label || node.codigo_produto_filho).appendTo($li);
        }
    }

    function loadStructure()
    {
        const codigoProdutoPai = $('#codigo_produto_pai').val();

        $.ajax({
            url: "{{ route("estrutura.load") }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                codigo_produto_pai: codigoProdutoPai
            },
            success: function (data)
            {
                renderTreeView(data);
            },
            error: function (error)
            {
                alert('Erro ao carregar estrutura:');
            }
        });
    }

    function addProduct()
    {
        var codigoProdutoPai = $('#codigo_produto_pai').val();
        var codigoProdutoFilho = $('#codigo_produto_filho').val();
        var quantidade = $('#quantidade').val();

        $.ajax({
            url: "{{ route("estruturas.store") }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                codigo_produto_pai: codigoProdutoPai,
                codigo_produto_filho: codigoProdutoFilho,
                quantidade: quantidade
            },
            success: function (data)
            {
                renderTreeView(data);
                $('#codigo_produto_filho').val('');
                $('#quantidade').val('');
                loadStructure()
            },
            error: function (error)
            {
                alert('Erro ao adicionar produto a estrutura:');
            }
        });
    }

</script>
@endsection

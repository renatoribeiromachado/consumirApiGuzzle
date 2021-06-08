
{{ $titulo }}

<a href="{{ route('produto.create') }}">Cadastrar novo</a>

@if(session('success'))
    {{ session('success') }}
@endif

<table>
    <tr>
        <th>Cod..</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>Imagem</th>
        <th>Editar</th>
        <th>Excluir</th>
    </tr>
@forelse($produtos->data as $produto)
    <tr>
        <td>{{ $produto->codigo }}</td>
        <td>{{ $produto->nome }}</td>
        <td>{{ $produto->price }}</td>
        <td><a href="{{ route('produto.edit', $produto->id) }}">Editar</a></td>
        <td><form action="{{ route('produto.destroy', $produto->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger">Deletar</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td>Itens não cadastrados</td>
    </tr>
@endforelse
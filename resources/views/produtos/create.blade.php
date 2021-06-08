{{ $titulo }}

<form action="{{ route('produto.store') }}" method='POST' enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <input type="text" name="codigo" class="form-control" value="" placeholder="Insira o Código">
    </div>
    <div class="form-group">
        <input type="text" name="nome" class="form-control" value="" placeholder="Insira o nome">
    </div>
    <div class="form-group">
        <input type="text" name="price" class="form-control" value="" placeholder="Insira o nome">
    </div>
    <div class="form-group">
        <input type="file" name="imagem" class="form-control" value="" placeholder="Insira uma imagem">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </div>
</form>
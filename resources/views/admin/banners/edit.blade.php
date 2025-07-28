<x-app-layout>
@section('content')
<h1>Editar Banner</h1>

<form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label for="titulo">Título</label>
        <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $banner->titulo) }}" required>
    </div>

    <div>
        <label for="imagem">Imagem Atual:</label><br>
        <img src="{{ asset('storage/' . $banner->imagem) }}" width="150" alt="Imagem atual">
        <br>
        <label for="imagem">Nova Imagem (opcional)</label>
        <input type="file" name="imagem" id="imagem">
    </div>

    <div>
        <label for="link">Link (opcional)</label>
        <input type="text" name="link" id="link" value="{{ old('link', $banner->link) }}">
    </div>

    <div>
        <label for="ordem">Ordem</label>
        <input type="number" name="ordem" id="ordem" value="{{ old('ordem', $banner->ordem) }}">
    </div>

    <div>
        <label for="carrossel">Carrossel?</label>
        <input type="checkbox" name="carrossel" id="carrossel" value="1" {{ old('carrossel', $banner->carrossel) ? 'checked' : '' }}>
    </div>

    <div>
        <label for="ativo">Ativo?</label>
        <input type="checkbox" name="ativo" id="ativo" value="1" {{ old('ativo', $banner->ativo) ? 'checked' : '' }}>
    </div>

    <div>
        <button type="submit">Atualizar</button>
        <a href="{{ route('admin.banners.index') }}">Cancelar</a>
    </div>
</form>
@endsection
</x-app-layout>

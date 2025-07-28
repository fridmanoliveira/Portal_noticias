<x-app-layout>
@section('content')
<h1>Editar Acesso Rápido</h1>

<form action="{{ route('admin.acessos-rapidos.update', $acesso->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="titulo">Título</label>
        <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $acesso->titulo) }}" required>
    </div>

    <div>
        <label for="icone">Ícone</label>
        <input type="text" name="icone" id="icone" value="{{ old('icone', $acesso->icone) }}">
    </div>

    <div>
        <label for="link">Link</label>
        <input type="text" name="link" id="link" value="{{ old('link', $acesso->link) }}" required>
    </div>

    <div>
        <label for="ordem">Ordem</label>
        <input type="number" name="ordem" id="ordem" value="{{ old('ordem', $acesso->ordem) }}">
    </div>

    <div>
        <label for="ativo">Ativo?</label>
        <input type="checkbox" name="ativo" id="ativo" value="1" {{ old('ativo', $acesso->ativo) ? 'checked' : '' }}>
    </div>

    <div>
        <button type="submit">Atualizar</button>
        <a href="{{ route('admin.acessos-rapidos.index') }}">Cancelar</a>
    </div>
</form>
@endsection
</x-app-layout>

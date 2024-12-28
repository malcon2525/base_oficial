@extends('layouts.app.adm.adm')

@section('title', 'Confirmar Exclusão')

@section('content')
<div class="container">
    <h1>Confirmar Exclusão de Usuário</h1>

    <!-- Exibe os dados do usuário -->
    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" id="name" class="form-control" value="{{ $user->name }}" disabled>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" id="email" class="form-control" value="{{ $user->email }}" disabled>
    </div>

    <div class="mb-3">
        <label for="ativo" class="form-label">Ativo</label>
        <input type="text" id="ativo" class="form-control" value="{{ $user->ativo ? 'Sim' : 'Não' }}" disabled>
    </div>

    <!-- Formulário de exclusão -->
    <form action="{{ route('usuario.excluir', $user->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
        @csrf
        @method('DELETE')
        
        <button type="submit" class="btn btn-danger me-3">Excluir Usuário</button>
        <a href="{{ route('usuario.consulta') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

@extends('layouts.app.adm.adm')

@section('title', 'Editar Usuário')

@section('content')

<div class="container">
    <h1>Editar Usuário</h1>

    <!-- Exibe mensagens de erro -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário de edição -->
    <form action="{{ route('usuario.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Indica que a requisição será um PUT (para atualização) -->

        <!-- Campo nome -->
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <!-- Campo email -->
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <!-- Campo senha -->
        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Digite a nova senha (ou deixe em branco para manter a atual)">
        </div>

        <!-- Campo confirmação de senha -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Senha</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>

        <!-- Campo ativo (checkbox) -->
        <div class="mb-3">
            <label for="ativo" class="form-label me-3">Ativo</label>
            <input type="checkbox" id="ativo" name="ativo" class="form-check-input" {{ $user->ativo ? 'checked' : '' }}>
        </div>

        <!-- Botões -->
        <button type="submit" class="btn btn-primary me-3">Salvar Alterações</button>
        <a href="{{ route('usuario.consulta') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@endsection

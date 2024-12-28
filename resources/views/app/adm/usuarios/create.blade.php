@extends('layouts.app.adm.adm')

@section('title', 'Cadastrar Novo Usuário')

@section('content')
<div class="container">
    <h1>Cadastrar Novo Usuário</h1>

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

    <!-- Formulário de cadastro -->
    <form action="{{ route('usuario.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirme a Senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="ativo" class="form-label">Usuário Ativo?</label>
            <select name="ativo" id="ativo" class="form-select" required>
                <option value="1" {{ old('ativo') == '1' ? 'selected' : '' }}>Sim</option>
                <option value="0" {{ old('ativo') == '0' ? 'selected' : '' }}>Não</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary me-3">Salvar</button>
        <a href="{{ route('usuario.consulta') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
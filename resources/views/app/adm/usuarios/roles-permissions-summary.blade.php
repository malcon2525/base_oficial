@extends('layouts.app.adm.adm')

@section('title', 'Resumo de Papéis e Permissões')

@section('content')
<div class="container">
    <h1>Resumo de Papéis e Permissões para o Usuário: {{ $user->name }}</h1>

    <div class="mb-4">
        <h5><strong>Papéis Associados:</strong></h5>
        <ul>
            @forelse($roles as $role)
                <li>{{ $role->name }}</li>
            @empty
                <li>Nenhum papel associado.</li>
            @endforelse
        </ul>
        <a href="{{ route('users.roles.edit', $user->id) }}" class="btn btn-info btn-sm me-2">Gerenciar Papeis</a>
    </div>

    <div class="mb-4">
        <h5><strong>Permissões Associadas:</strong></h5>
        <ul>
            @forelse($permissions as $permission)
                <li>{{ $permission->name }}</li>
            @empty
                <li>Nenhuma permissão associada.</li>
            @endforelse
        </ul>
        <a href="{{ route('users.permissions.edit', $user->id) }}" class="btn btn-info btn-sm me-2">Gerenciar Permissoes</a>
    </div>

    <a href="{{ route('usuario.consulta') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection

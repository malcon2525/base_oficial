@extends('layouts.app.adm.adm')

@section('title', 'Gerenciar Papéis do Usuário')

@section('content')
<div class="container">
    <h1>Gerenciar Papéis para o Usuário: {{ $user->name }}</h1>

    <form action="{{ route('users.roles.update', $user->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <h5>Selecione os Papéis para o Usuário</h5>
            <div class="row">
                @foreach($roles as $role)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input 
                                type="checkbox" 
                                name="roles[]" 
                                value="{{ $role->id }}" 
                                id="role-{{ $role->id }}"
                                class="form-check-input"
                                {{ in_array($role->id, $userRoles) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="role-{{ $role->id }}">
                                {{ $role->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-success me-3">Salvar Papéis</button>
        <a href="{{ route('usuario.consulta') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
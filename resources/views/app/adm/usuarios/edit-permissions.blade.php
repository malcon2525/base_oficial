@extends('layouts.app.adm.adm')

@section('title', 'Gerenciar Permissões do Usuário')

@section('content')
<div class="container">
    <h1>Gerenciar Permissões para o Usuário: <span class="destaque1">{{ $user->name }}</span></h1>

    <form action="{{ route('users.permissions.update', $user->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <h5>Permissões Disponíveis</h5>
            <div class="row border-container">
                @foreach($permissions as $permission)
                    <div class="col-md-4 ">
                        <div class="form-check">
                            <input 
                                type="checkbox" 
                                name="permissions[]" 
                                value="{{ $permission->name  }}" 
                                id="permission-{{ $permission->id }}"
                                class="form-check-input"
                                {{ in_array($permission->id, $userPermissions) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="permission-{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-success me-3">Salvar Permissões</button>
        <a href="{{ route('users.roles.permissions.summary', ['user' => $user->id]) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
@push('styles')
<style>
    .border-container{
        border: 1px solid #d6d6d6;
        border-radius: 5px;
        padding: 10px;
    }
    .destaque1{
        color: #0080c0;
        font-weight: 600;
    }
    
</style>
@endpush
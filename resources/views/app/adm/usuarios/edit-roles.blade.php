@extends('layouts.app.adm.adm')

@section('title', 'Gerenciar Papéis do Usuário')

@section('content')
<div class="container">
    <h1>Gerenciar Papéis para o Usuário: <span class="destaque1">{{ $user->name }}</span> </h1>

    <form action="{{ route('users.roles.update', $user->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <h5>Selecione os Papéis para o Usuário</h5>
            <div class="row ">
                @foreach($roles as $role)
                    <div class="col-md-4 border-container me-1">
                        <div class="form-check">
                            <input 
                                type="checkbox" 
                                name="roles[]" 
                                value="{{ $role->id }}" 
                                id="role-{{ $role->id }}"
                                class="form-check-input"
                                {{ in_array($role->id, $userRoles) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="role-{{ $role->id }}" >
                                <span class="destaque1">{{ $role->name }}</span>
                            </label>
                            <div class="mt-1">
                                <strong >Permissões:</strong>
                                @if($role->permissions->isEmpty())
                                    Nenhuma permissão associada.
                                @else
                                    [ {{ $role->permissions->pluck('name')->join(', ') }} ]
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-success me-3">Salvar Papéis</button>
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
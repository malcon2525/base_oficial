@extends('layouts.app.adm.adm')

@section('title', 'Resumo de Papéis e Permissões')

@section('content')
<div class="container">
    <h1>Resumo de Papéis e Permissões para o Usuário: {{ $user->name }}</h1>

    @if (session('success'))
        <div id="mess-success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <h5><strong>Papéis Associados:</strong></h5>
        <ul>
            @forelse($roles as $role)
                <li>{{ $role->name }}
                    <br>
                    <strong>Permissões:</strong>
                    @if($role->permissions->isEmpty())
                        Nenhuma permissão associada a este papel.
                    @else
                        [ {{ $role->permissions->pluck('name')->join(', ') }} ]
                    @endif
                </li>
            @empty
                <li>Nenhum papel associado.</li>
            @endforelse
        </ul>
        <a href="{{ route('users.roles.edit', $user->id) }}" class="btn btn-gerenciar btn-sm me-2">Gerenciar Papeis</a>
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
        <a href="{{ route('users.permissions.edit', $user->id) }}" class="btn btn-gerenciar btn-sm me-2">Gerenciar Permissoes</a>
    </div>

    <a href="{{ route('usuario.consulta') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection

@push('scripts')
<script>
    // Código para fade out da mensagem de sucesso
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            const alert = document.getElementById('mess-success-alert');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);
    });
</script>
@endpush

@push('styles')
<style>
    .btn-gerenciar{
        border: 1px solid #d1d1d1;
        margin-left: 30px
    }
    .btn-gerenciar:hover{
        
        background-color: rgba(149, 169, 177, 0.486);
        
    }
    
</style>
@endpush
@extends('layouts.app.adm.adm')

@section('title', 'Gerenciamento Permissões')

@section('content')
<div class="container">
    <h1>Gerenciamento de Permissões</h1>

    @if (session('success'))
        <div id="mess-success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <strong>Total de registros:</strong> {{ $permissions->count() }}
        </div>
        <div>
            <a href="{{ route('permissions.create') }}" class="btn btn-primary">Cadastrar Nova Permissão</a>
        </div>
    </div>

    <!-- Tabela de Permissões -->
    <table class="table table-striped table-bordered">
        <thead class="bg-dark text-white">
            <tr>
                <th>ID</th>
                <th>Permissão</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td class="actions">
                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning btn-sm me-2">Editar</a>
                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta permissão?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginação -->
    <div class="d-flex justify-content-center">
        {{ $permissions->links() }}
    </div>
</div>
@endsection

@push('styles')
    <style>
        .actions {
            width: 150px;
        }

    </style>
@endpush

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


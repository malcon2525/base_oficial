@extends('layouts.app.adm.adm')

@section('title', 'Gerenciamento de Permissões - Consulta de Papéis')

@section('content')
<div class="container">
    <h1>Gerenciamento de Papeis</h1>

    @if (session('success'))
        <div id="mess-success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <strong>Total de registros:</strong> {{ $roles->count() }}
        </div>
        <div>
            <a href="{{ route('roles.create') }}" class="btn btn-primary">Cadastrar Novo Papel</a>
        </div>
    </div>

    <!-- Tabela de Papéis -->
    <table class="table table-striped table-bordered">
        <thead class="bg-dark text-white">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm me-2">Editar</a>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este papel?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginação -->
    <div class="d-flex justify-content-center">
        {{ $roles->links() }}
    </div>
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

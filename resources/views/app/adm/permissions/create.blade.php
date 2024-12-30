@extends('layouts.app.adm.adm')

@section('title', 'Cadastro de Nova Permissão')

@section('content')
<div class="container">
    <h1>Cadastrar Nova Permissão</h1>

    <!-- Exibir erros de validação -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário -->
    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome da Permissão</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Digite o nome da permissão" value="{{ old('name') }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>
</div>
@endsection

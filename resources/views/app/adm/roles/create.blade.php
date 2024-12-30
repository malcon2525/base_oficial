@extends('layouts.app.adm.adm')

@section('title', 'Cadastro de Novo Papel')

@section('content')
<div class="container">
    <h1>Cadastrar Novo Papel</h1>

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
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome do Papel</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Digite o nome do papel" value="{{ old('name') }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>
</div>
@endsection

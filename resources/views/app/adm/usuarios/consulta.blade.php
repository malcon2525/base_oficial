@extends('layouts.app.adm.adm')

@section('title', 'Gerenciamento de Usuários - Consulta')

@section('content')
<div class="container">
    <h1>Gerenciamento de Usuários - Consulta</h1>

    @if (session('success'))
        <div id="mess-success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Passando o array para o componente Vue -->
    <user-list :users="{{ json_encode($users) }}"></user-list>
</div>

@endsection

@push('scripts')
<script>
    //O código foi colocado dentro de document.addEventListener('DOMContentLoaded') para garantir que só execute após o DOM estar completamente carregado.
    document.addEventListener('DOMContentLoaded', () => {
        // Aguarda 5 segundos (5000ms) e depois oculta a div com fade out
        setTimeout(() => {
            const alert = document.getElementById('mess-success-alert');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease"; // Faz o fade durar 0.5s
                alert.style.opacity = "0"; // Define a opacidade como 0 para o fade out
                setTimeout(() => alert.remove(), 500); // Remove o elemento após o fade (0.5s)
            }
        }, 5000); // Tempo inicial de espera: 5 segundos
    });
</script>
@endpush

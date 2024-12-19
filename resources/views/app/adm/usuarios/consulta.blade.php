@extends('layouts.app.adm.adm')

@section('title', 'Página Inicial')

@section('content')


<div class="container">
    <h1>Gerenciamento de Usuários - consulta</h1>

    <!-- Passando o array para o componente Vue -->
    <user-list :users="{{ json_encode($users) }}"></user-list>
</div>



@endsection
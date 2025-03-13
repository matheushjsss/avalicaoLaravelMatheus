@extends('layouts.admin') <!-- Assume que você está usando um layout principal -->

@section('content')
    <div class="min-h-screen bg-gray-100 p-6">
        <!-- Barra de boas-vindas -->
        <div class="bg-white shadow-sm rounded-lg p-4 mb-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800">Bem-vindo(a), @auth {{ auth()->user()->name }} @endauth!</h1>
                <div class="text-sm text-gray-600">
                    {{ now()->format('d/m/Y H:i') }} <!-- Exibe a data e hora atual -->
                </div>
            </div>
        </div>

        <!-- Conteúdo principal -->
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Home Page</h2>
            <p class="text-gray-600 mb-4">
                Esta é a página inicial do painel administrativo. Aqui você pode gerenciar usuários, perfis, permissões.
            </p>
        </div>
    </div>
@endsection
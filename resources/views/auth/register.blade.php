@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-8 space-y-6 bg-white shadow-lg rounded-2xl">
        <h2 class="text-2xl font-bold text-center text-gray-900">Crie sua conta</h2>
        <p class="text-sm text-gray-500 text-center">Registre-se para acessar o sistema</p>

        @if ($errors->any())
            <div class="text-red-500 text-sm text-center bg-red-100 p-2 rounded-md">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form class="mt-4 space-y-4" method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" id="name" name="name" required
                    class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300 focus:border-blue-500">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300 focus:border-blue-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300 focus:border-blue-500">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300 focus:border-blue-500">
            </div>

            <button type="submit"
                class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                Registrar
            </button>

            <p class="text-sm text-center text-gray-600">
                Já tem uma conta?
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Faça login</a>
            </p>
        </form>
    </div>
</div>
@endsection

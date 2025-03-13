@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Adicionar Perfil ao Usuário: {{ $user->name }}</h1>

        <!-- Exibir mensagens de sucesso ou erro -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.users.addperfispost', $user->id) }}" method="POST">
            @csrf

            <!-- Campo para selecionar o perfil -->
            <div class="mb-4">
                <label for="role_id" class="block text-sm font-medium text-gray-700">Selecione um Perfil</label>
                <select name="role_id" id="role_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    <option value="">Selecione um perfil</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Botões -->
            <div class="flex justify-end">
                <a href="{{ route('admin.users.perfis', $user->id) }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-150 mr-2">
                    Cancelar
                </a>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-150">
                    Adicionar Perfil
                </button>
            </div>
        </form>
    </div>
@endsection
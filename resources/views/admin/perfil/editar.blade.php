@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Editar Perfil: {{ $role->name }}</h1>

        <!-- Exibir mensagens de sucesso ou erro -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulário de edição -->
        <form action="{{ route('admin.perfil.atualizar', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Lista de permissões -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Permissões</label>
                <div class="mt-2 space-y-2">
                    @foreach($permissions as $permission)
                        <div class="flex items-center">
                            <input type="checkbox" name="permissions[]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                            <label for="permission_{{ $permission->id }}" class="ml-2 text-sm text-gray-700">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Botões -->
            <div class="flex justify-end">
                <a href="{{ route('admin.perfis') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-150 mr-2">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-150">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
@endsection
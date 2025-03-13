@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-4">
        <!-- Cabeçalho com botões de pesquisa e adicionar -->
        <div class="flex justify-between items-center mb-6">
            
            <h1 class="text-2xl font-bold">Usuarios cadastrados</h1>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Nome</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Açoes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <a href="{{ route('admin.users.perfis', $user->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2 hover:bg-blue-600 transition duration-150">
                                    Perfis
                                </a>
                                <a href="{{ route('admin.users.editar', $user->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition duration-150">
                                    Editar
                                </a>
                                <form action="{{ route('admin.users.excluir', $user->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-150">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Rodapé com paginação -->
        <div class="mt-4 py-4 border-t border-gray-200 flex justify-between items-center">
            <div>
                <a href="{{ route('admin.users.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg ml-2 hover:bg-green-600 transition duration-150">
                    Adicionar
                </a>
            </div>
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection

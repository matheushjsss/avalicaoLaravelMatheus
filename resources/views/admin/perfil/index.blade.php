@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-4">
        <!-- Cabeçalho com botões de pesquisa e adicionar -->
        <div class="flex justify-between items-center mb-6">
            
            <h1 class="text-2xl font-bold">Pefis cadastrados</h1>
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
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Açoes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($roles as $role)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $role->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <a href="{{ route('admin.perfil.editar', $role->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition duration-150">
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::where('name', '!=', 'admin')->paginate(10);
        return view('admin.perfil.index', compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editar($id){
        // Busca o perfil pelo ID ou retorna um erro 404
        $role = Role::findOrFail($id);

        // Busca todas as permissões disponíveis
        $permissions = Permission::where('name', '!=', 'admin')->get();

        // Retorna a view com os dados
        return view('admin.perfil.editar', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function atualizar(Request $request, $id){
        // Validação dos dados
        $request->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Busca o perfil pelo ID
        $role = Role::findOrFail($id);

        // Converte os IDs das permissões em nomes de permissões
        $permissionNames = Permission::whereIn('id', $request->permissions ?? [])
            ->pluck('name')
            ->toArray();

        // Sincroniza as permissões do perfil
        $role->syncPermissions($permissionNames);

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('admin.perfis')
            ->with('success', 'Permissões do perfil atualizadas com sucesso!');
    }
}

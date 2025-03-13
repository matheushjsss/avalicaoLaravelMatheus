<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        // Filtra os usuários que não têm a role "admin"
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->paginate(10);
    
        return view('admin.users.index', compact('users'));
    }

    public function create(){
        if(request()->isMethod('get')){
            return view('admin.users.create');
        }

        if(request()->isMethod('post')){
            $data = request()->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            if (User::where('email', $data['email'])->exists()) {
                return redirect()->route('admin.users.create')->with('error', 'Email ja cadastrado!');
            }

            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);

            return redirect()->route('admin.users')->with('success', 'Usuário criado com sucesso!');
        }
    }

    public function editar($id){
            $data = request()->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            ]);

            $user = User::findOrFail($id);
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->save();

            return redirect()->route('admin.users')->with('success', 'Usuário editado com sucesso!');
    }

    public function destroy($id){

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Usuário excluído com sucesso!');
    }
    public function adicionarPerfilshow($id){
        $user = User::findOrFail($id);
        $roles = Role::where('name', '!=', 'admin')->get();
        return view('admin.users.addperfil', compact('user', 'roles'));
    }

    public function adicionarPerfil(Request $request, $id){
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $role = Role::findOrFail($request->role_id);
        $user->assignRole($role);

        return redirect()->route('admin.users.perfis', $user->id)->with('success', 'Perfil adicionado com sucesso!');
    }

    public function removerPerfil($userId, $roleId){

        $user = User::findOrFail($userId);
        $role = Role::findOrFail($roleId);
        $user->removeRole($role);
        
        return redirect()->route('admin.users.perfis', $user->id)->with('success', 'Perfil removido com sucesso!');
    }

    public function perfis($id){
        $user = User::findOrFail($id);
        $roles = $user->roles()->paginate(10);
        return view('admin.users.perfis', compact('user', 'roles'));
    }
}

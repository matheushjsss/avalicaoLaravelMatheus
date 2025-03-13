<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Criar permissÃµes individuais
        Permission::create(['name' => 'admin']); // Permissão apenas para o admin
        Permission::create(['name' => 'acesso produtos']);
        Permission::create(['name' => 'acesso categ']);
        Permission::create(['name' => 'acesso marcas']);

        // Criar as funÃ§Ãµes (roles)
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('admin');

        $produtos = Role::create(['name' => 'produtos']);
        $produtos->givePermissionTo('acesso produtos');

        $categorias = Role::create(['name' => 'categorias']);
        $categorias->givePermissionTo('acesso categ');

        $marcas = Role::create(['name' => 'marcas']);
        $marcas->givePermissionTo('acesso marcas');

        $gerente = Role::create(['name' => 'gerente']);
        $gerente->givePermissionTo(['acesso produtos', 'acesso categ', 'acesso marcas']);

        // Definir senha padrão
        $password = Hash::make('123456');

        // Criar Usuarios com a senha padrão
        $adminUser = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => $password,
        ]);
        $adminUser->assignRole($admin);

        $produtosUser = User::create([
            'name' => 'Usuario Produtos',
            'email' => 'produtos@example.com',
            'password' => $password,
        ]);
        $produtosUser->assignRole($produtos);

        $categoriasUser = User::create([
            'name' => 'Usuario Categorias',
            'email' => 'categorias@example.com',
            'password' => $password,
        ]);
        $categoriasUser->assignRole($categorias);

        $marcasUser = User::create([
            'name' => 'Usuario Marcas',
            'email' => 'marcas@example.com',
            'password' => $password,
        ]);
        $marcasUser->assignRole($marcas);

        $gerenteUser = User::create([
            'name' => 'Usuario Gerente',
            'email' => 'gerente@example.com',
            'password' => $password,
        ]);
        $gerenteUser->assignRole($gerente);
    }
}

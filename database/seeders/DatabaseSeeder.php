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
        Permission::create(['name' => 'manage users']); // PermissÃ£o apenas para o admin
        Permission::create(['name' => 'access products']);
        Permission::create(['name' => 'access categories']);
        Permission::create(['name' => 'access brands']);

        // Criar as funÃ§Ãµes (roles)
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('manage users');

        $produtos = Role::create(['name' => 'produtos']);
        $produtos->givePermissionTo('access products');

        $categorias = Role::create(['name' => 'categorias']);
        $categorias->givePermissionTo('access categories');

        $marcas = Role::create(['name' => 'marcas']);
        $marcas->givePermissionTo('access brands');

        $gerente = Role::create(['name' => 'gerente']);
        $gerente->givePermissionTo(['access products', 'access categories', 'access brands']);

        // Definir senha padrÃ£o
        $password = Hash::make('123456');

        // Criar usuÃ¡rios com a senha padrÃ£o
        $adminUser = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => $password,
        ]);
        $adminUser->assignRole($admin);

        $produtosUser = User::create([
            'name' => 'UsuÃ¡rio Produtos',
            'email' => 'produtos@example.com',
            'password' => $password,
        ]);
        $produtosUser->assignRole($produtos);

        $categoriasUser = User::create([
            'name' => 'UsuÃ¡rio Categorias',
            'email' => 'categorias@example.com',
            'password' => $password,
        ]);
        $categoriasUser->assignRole($categorias);

        $marcasUser = User::create([
            'name' => 'UsuÃ¡rio Marcas',
            'email' => 'marcas@example.com',
            'password' => $password,
        ]);
        $marcasUser->assignRole($marcas);

        $gerenteUser = User::create([
            'name' => 'UsuÃ¡rio Gerente',
            'email' => 'gerente@example.com',
            'password' => $password,
        ]);
        $gerenteUser->assignRole($gerente);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::factory()->count(1)->create();
        
        Permission::create(
            ['name' => 'users', 'description' => 'Usuários','uuid' => Str::uuid()]
        );
        
        Permission::create(
            ['name' => 'roles', 'description' => 'Funções','uuid' => Str::uuid()]
        );

        Permission::create(
            ['name' => 'tables', 'description' => 'Mesas','uuid' => Str::uuid()]
        );
        
        Permission::create(
            ['name' => 'plans', 'description' => 'Planos','uuid' => Str::uuid()]
        );        
        Permission::create(
            ['name' => 'groups', 'description' => 'Grupos','uuid' => Str::uuid()]
        );   

        Permission::create(
            ['name' => 'permissions', 'description' => 'Permissões','uuid' => Str::uuid()]
        );     
          
        Permission::create(
            ['name' => 'products', 'description' => 'Produtos','uuid' => Str::uuid()]
        );
    }
}

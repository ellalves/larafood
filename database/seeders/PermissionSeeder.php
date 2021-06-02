<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Group;
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
        $p1 = Permission::factory()->count(1)->create();

        $p2 = Permission::create(
            ['name' => 'users', 'description' => 'Usuários','uuid' => Str::uuid()]
        );

        $p3 = Permission::create(
            ['name' => 'roles', 'description' => 'Funções','uuid' => Str::uuid()]
        );
        
        $p4 = Permission::create(
            ['name' => 'plans', 'description' => 'Planos','uuid' => Str::uuid()]
        );        
        $p5 = Permission::create(
            ['name' => 'groups', 'description' => 'Grupos','uuid' => Str::uuid()]
        );   

        $p6 = Permission::create(
            ['name' => 'permissions', 'description' => 'Permissões','uuid' => Str::uuid()]
        );     
          
        $p7 = Permission::create(
            ['name' => 'products', 'description' => 'Produtos','uuid' => Str::uuid()]
        );     
          
        $p8 = Permission::create(
            ['name' => 'categories', 'description' => 'Categorias','uuid' => Str::uuid()]
        );

        $p9 = Permission::create(
            ['name' => 'tables', 'description' => 'Mesas','uuid' => Str::uuid()]
        );

        $p10 = Permission::create(
            ['name' => 'orders', 'description' => 'Pedidos','uuid' => Str::uuid()]
        );

        Group::first()->permissions()->attach([1,2,6,7,8,9,10]);

        Role::first()->permissions()->attach([1,2,6,7,8,9,10]);
    }
}

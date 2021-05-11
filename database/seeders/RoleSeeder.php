<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $r1 = Role::factory()->count(1)->create();
        
        $r2 = Role::create(
            ['name' => 'Entregador', 'description' => 'Entregador da empresa','uuid' => Str::uuid()]
        );
        
        $r1 = Role::create(
            ['name' => 'Gerente', 'description' => 'Gerente da empresa','uuid' => Str::uuid()]
        );

        $r3 = Role::create(
            ['name' => 'Caixa', 'description' => 'Caixa da empresa','uuid' => Str::uuid()]
        );
        
        $r4 = Role::create(
            ['name' => 'Garçom', 'description' => 'Garçom da empresa','uuid' => Str::uuid()]
        );

        $r5 = Role::create(
            ['name' => 'Cozinheiro', 'description' => 'Cozinheiro da empresa','uuid' => Str::uuid()]
        );   

        $r6 = Role::create(
            ['name' => 'Vendedor', 'description' => 'Vendedor da empresa','uuid' => Str::uuid()]
        );     
          
        $r7 = Role::create(
            ['name' => 'Estoque', 'description' => 'Estoque da empresa','uuid' => Str::uuid()]
        );

        Role::first()->permissions()->attach([1,2,3,4,5,6,7]);
    }
}
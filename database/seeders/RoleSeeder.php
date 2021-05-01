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
        Role::factory()->count(1)->create();
        
        Role::create(
            ['name' => 'Entregador', 'description' => 'Entregador da empresa','uuid' => Str::uuid()]
        );
        
        Role::create(
            ['name' => 'Gerente', 'description' => 'Gerente da empresa','uuid' => Str::uuid()]
        );

        Role::create(
            ['name' => 'Caixa', 'description' => 'Caixa da empresa','uuid' => Str::uuid()]
        );
        
        Role::create(
            ['name' => 'Garçom', 'description' => 'Garçom da empresa','uuid' => Str::uuid()]
        );        
        Role::create(
            ['name' => 'Cozinheiro', 'description' => 'Cozinheiro da empresa','uuid' => Str::uuid()]
        );   

        Role::create(
            ['name' => 'Vendedor', 'description' => 'Vendedor da empresa','uuid' => Str::uuid()]
        );     
          
        Role::create(
            ['name' => 'Estoque', 'description' => 'Estoque da empresa','uuid' => Str::uuid()]
        );
    }
}
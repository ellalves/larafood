<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Everton Alves',
            'username' => 'ellalvesdev',
            'sex' => 'M',
            'email' => config("acl.admins")[0],
            'phone' => '(75)99189-6668',
            'birth' => '1982-06-15',
            'bio' => 'Administrador do sistema',
        ];

        $tenant = Tenant::first();
        $user = User::factory()
                            ->count(9)
                            ->for($tenant)
                            ->create();
        
        // Atualiza com os dados do adm master
        User::first()->update($data);
    }
}

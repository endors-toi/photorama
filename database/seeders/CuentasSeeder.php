<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CuentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cuentas')->insert([
            ['user' => 'user1', 'password' => Hash::make('password123'), 'nombre' => 'John', 'apellido' => 'Doe', 'perfil_id' => 1],
            ['user' => 'user2', 'password' => Hash::make('password123'), 'nombre' => 'Jane', 'apellido' => 'Doe', 'perfil_id' => 2],
            ['user' => 'user3', 'password' => Hash::make('password123'), 'nombre' => 'Mary', 'apellido' => 'Smith', 'perfil_id' => 1],
            ['user' => 'user4', 'password' => Hash::make('123'), 'nombre' => 'Peter', 'apellido' => 'Jones', 'perfil_id' => 2],
            ['user' => 'user5', 'password' => Hash::make('password123'), 'nombre' => 'Susan', 'apellido' => 'Brown', 'perfil_id' => 2],
            ['user' => 'user6', 'password' => Hash::make('password123'), 'nombre' => 'David', 'apellido' => 'Williams', 'perfil_id' => 1],
            ['user' => 'user7', 'password' => Hash::make('password123'), 'nombre' => 'Emily', 'apellido' => 'Green', 'perfil_id' => 2],
            ['user' => 'user8', 'password' => Hash::make('password123'), 'nombre' => 'Michael', 'apellido' => 'Black', 'perfil_id' => 2],
            ['user' => 'user9', 'password' => Hash::make('password123'), 'nombre' => 'Sarah', 'apellido' => 'White', 'perfil_id' => 1],
            ['user' => 'user10', 'password' => Hash::make('password123'), 'nombre' => 'Thomas', 'apellido' => 'Blue', 'perfil_id' => 2],
        ]);
    }
}

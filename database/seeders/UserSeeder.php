<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User; // Importar o modelo User
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            // Criação do administrador
            User::create([
                'name' => 'adm',
                'email' => 'adm@adm.com.br',
                'password' => Hash::make('123'),
                'ativo' => 1,
            ]);

            // Criação de 20 usuários fictícios
            for ($i = 1; $i <= 20; $i++) {
                User::create([
                    'name' => "Usuário {$i}",
                    'email' => "usuario{$i}@example.com",
                    'password' => Hash::make('123'),
                    'ativo' => 1,
                ]);
            }
        }
    }

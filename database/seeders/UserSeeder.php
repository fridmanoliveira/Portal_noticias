<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Master Admin',
                'email' => 'master@cristinocastroonline.com',
                'password' => Hash::make('U2JxmL31k'),
                'role' => 'master'
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@cristinocastroonline.com',
                'password' => Hash::make('X9XYPD8cQ'),
                'role' => 'admin'
            ],
            [
                'name' => 'Usuario Conteudo',
                'email' => 'conteudo@cristinocastroonline.com',
                'password' => Hash::make('X9XYPD8cQ'),
                'role' => 'conteudo'
            ],
            [
                'name' => 'Usuario PPA',
                'email' => 'ppa@cristinocastroonline.com',
                'password' => Hash::make('X9XYPD8cQ'),
                'role' => 'ppa'
            ],
            [
                'name' => 'Usuario Obras',
                'email' => 'obras@cristinocastroonline.com',
                'password' => Hash::make('X9XYPD8cQ'),
                'role' => 'obras'
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']], // procura pelo email
                [
                    'name' => $userData['name'],
                    'password' => $userData['password']
                ]
            );

            $user->syncRoles([$userData['role']]); // garante que ele terá apenas essa role
        }

        $this->command->info('Usuários iniciais criados com sucesso!');
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run()
    // {
    //     $this->call([
    //         CategoriaNoticiaSeeder::class,
    //         NoticiaSeeder::class,
    //         AcessoRapidoSeeder::class,
    //         UserSeeder::class
    //     ]);
    // }
    public function run()
    {
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
        ]);
    }

}

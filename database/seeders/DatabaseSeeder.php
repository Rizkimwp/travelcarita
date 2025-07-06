<?php

namespace Database\Seeders;

use App\Models\ProfileWeb;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        ProfileWeb::create([
            'title' => 'Website Wisata Nabii',
            'id_galery' => null,
            'contact' => '081234567890',
            'deskripsi' => 'Ini adalah deskripsi default dari profile website.',
            'email' => 'info@example.com',
        ]);
    }
}
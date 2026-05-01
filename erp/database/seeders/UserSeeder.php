<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'shivam.sh0023@gmail.com'],
            [
                'name' => 'Shivam Sharma',
                'password' => bcrypt('admin123'),
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'Insurance Advisor',
            'email' => 'advisor@example.com',
            'password' => bcrypt('password'),
        ]);

        $clients = \App\Models\Client::factory(5)->create([
            'user_id' => $user->id,
        ]);

        foreach ($clients as $client) {
            \App\Models\Query::factory()->create([
                'user_id' => $user->id,
                'client_id' => $client->id,
                'subject' => 'Policy Coverage Inquiry',
                'status' => 'open',
            ]);

            \App\Models\Claim::factory()->create([
                'user_id' => $user->id,
                'client_id' => $client->id,
                'status' => 'submitted',
            ]);

            \App\Models\Renewal::factory()->create([
                'user_id' => $user->id,
                'client_id' => $client->id,
                'expiry_date' => now()->addDays(rand(5, 25)),
                'status' => 'pending',
            ]);
        }
    }
}

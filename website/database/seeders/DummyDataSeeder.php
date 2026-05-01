<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Query;
use App\Models\Claim;
use App\Models\Renewal;
use App\Models\Staff;
 
class DummyDataSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email', 'shivam.sh0023@gmail.com')->first();
        
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Shivam Sharma',
                'email' => 'shivam.sh0023@gmail.com',
                'password' => bcrypt('admin123'),
            ]);
        }
 
        // Create Clients
        $clients = Client::factory()->count(25)->create(['user_id' => $user->id]);
 
        // Create Queries
        foreach ($clients->random(15) as $client) {
            Query::factory()->count(rand(1, 3))->create([
                'user_id' => $user->id,
                'client_id' => $client->id,
            ]);
        }
 
        // Create Claims
        foreach ($clients->random(10) as $client) {
            Claim::factory()->count(rand(1, 2))->create([
                'user_id' => $user->id,
                'client_id' => $client->id,
            ]);
        }
 
        // Create Renewals
        foreach ($clients->random(20) as $client) {
            Renewal::factory()->create([
                'user_id' => $user->id,
                'client_id' => $client->id,
            ]);
        }
 
        // Create Staff
        Staff::factory()->count(8)->create(['user_id' => $user->id]);
    }
}

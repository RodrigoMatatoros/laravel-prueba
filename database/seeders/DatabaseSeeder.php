<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\TaskSeeder;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        //crear usuario de prueba
        $user = User::factory()->create([
            'name' => 'Usuario Demo',
            'email' => 'demo@example.com',
            'password'=>Hash::make('password'),
        ]);
        $this->call(CategorySeeder::class);
        $this->call(TaskSeeder::Class);
        
    
    }
}

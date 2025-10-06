<?php

namespace Database\Seeders;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
    public function run(): void
    {
        //
        $users = User::all();
        $categories = Category::all();
        //Por cada usuario le meto unas tareas y luego a esas tareas las enlazo con categorias
        foreach($users as $user){
            Task::factory()->count(rand(2,4))->create(
            ['user_id' => $user->id])
                ->each(function ($task) use ($categories) {
                    if ($categories->isNotEmpty()) {
                        $random = $categories->random(rand(1, 2));
                        $task->categories()->attach($random);
                    }
            });
        }
        
    }
}

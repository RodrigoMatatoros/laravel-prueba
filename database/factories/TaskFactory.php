<?php

namespace Database\Factories;use App\Models\User;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' =>$this->faker->sentence(),
            'description'=>$this->faker->text(1000),
            'due_date' => $this->faker->dateTimeBetween('now', '+30 days'),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']),
            'user_id' => User::factory(),
        ];
    }

    public function withExistingCategories($categories)
    {
        return $this->afterCreating(function (Task $task) use ($categories) {
            $task->categories()->attach($categories);
        });
    }
}

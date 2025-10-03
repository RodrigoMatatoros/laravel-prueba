<?php

namespace Database\Seeders;
use App\Model\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $category = new Category();
        $category->name="Comida";
        $category->color="azul";
        $category-> save();

        $category2 = new Category();
        $category2->name="Casa";
        $category2->color="amarillo";
        $category2-> save();

        $category3 = new Category();
        $category3->name="Programar";
        $category3->color="rojo";
        $category3-> save();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::enableForeignKeyConstraints();
        Schema::create('taskcategories', function (Blueprint $table) {
            $table->id();
            /*$table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('category_id');*/
            $table->timestamps();

            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        // 
        Schema::dropIfExists('taskcategories');
    }
};


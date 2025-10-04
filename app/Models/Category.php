<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey ='id';
    public $incrementing = true;
    protected $fillable = [
        'name',
        'color',
    ];
    public function tasks(){
        return $this->belongsToMany(Task::class, 'taskcategories', 'category_id', 'task_id');
       
    }
}
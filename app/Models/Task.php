<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $primaryKey ='id';
    public $incrementing = true;
    protected $fillable = [
        'name',
        'description',
        'status',
        'due_date',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'taskcategories', 'task_id', 'category_id');
    }
    public function scopeFiltrarStatus($query, $userId, $status = 'all'){
        if($status!='all'){
            $query->where('status',$status);
        }
        return $query;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'user_id',
        'task_id',
        'todo_text',
        'is_completed',
    ];
    public function task(){
        return $this->belongs('App\Task', 'id' , 'task_id');
    }
    public function user(){
        return $this->belongs('App\Task', 'id' , 'user_id');
    }
}

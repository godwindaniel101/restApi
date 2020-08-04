<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=[
        'task_id',
        'company_id',
        'user_id',
        'project_id',
        'task_name',
        'assiged_to',
        'assign_by',
        'start_date',
        'end_date',
        'warn_date',
        'task_status',
        'task_priority',
        'task_description',
        'percentage_completed',
    ];
    public function assignby(){
        return $this->hasOne('App\User','id', 'assign_by');
    }
    public function assignto(){
        return $this->hasOne('App\Employee','id', 'assiged_to');
    }
}

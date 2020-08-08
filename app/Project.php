<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
            'user_id',
            'company_id',
            'project_name',
            'project_address',
            'project_supervisor',
            'ast_project_supervisor',
            'project_description',
            'start_date',
            'end_date',
    ];
    public function supervisor(){
      return  $this->hasOne('App\Employee' , 'id' , 'project_supervisor');
    }
    public function astsupervisor(){
        return  $this->hasOne('App\Employee' , 'id' , 'ast_project_supervisor');
      }
    public function isCompleted($query)
      {
          return $query->where('project_supervisor','==', '3');    
      }
}

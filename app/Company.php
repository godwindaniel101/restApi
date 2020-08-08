<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'id',
        'company_logo',
        'company_description',
    ];
    public function employee(){
        return $this->hasMany('App\Employee','company_id','id');
    }
    public function project(){
        return $this->hasMany('App\Project','company_id','id');
    }
    public function task(){
        return $this->hasMany('App\Task','company_id','id');
    }
    public function user(){
        return $this->hasMany('App\User','company_id','id');
    }
    // public function activeemployee(){
    //     return $this->model->with(['project'=>function($q){
    //         $q->where()
    //     }])->get()
    // }
  
//     $this->model->with(['invoice'])
//     ->with(['referrerBelong'=> function($q)
//     {
//         $q->with(['invoice']);
//      }]);

// }]);
}

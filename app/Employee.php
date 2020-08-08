<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
   protected $fillable = [
        'user_id',
        'company_id',
        'first_name',
        'last_name',
        'middle_name',
        'date_of_birth',
        'martial_status',
        'sex',
        'phone_no',
        'alt_phone_no',
        'email',
        'department',
        'position',
        'salary',
        'access_level',
        'experience_years',
        'qualification',
        'employee_type',
        'start_date',
        'country',
        'state',
        'city'
   ];
   public function user(){
      return $this->hasOne('App\User' , 'id' , 'user_id');
   }
   public function task(){
      return $this->hasOne('App\Task' , 'assiged_to' , 'id');
   }

}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable , HasApiTokens ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone_no','company_id','user_role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function company(){
        // return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
        return $this->hasOne('App\Company', 'id', 'id');
    }
    public function employee(){
        // return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
        return $this->hasOne('App\Employee', 'user_id', 'id');
    }
}

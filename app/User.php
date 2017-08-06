<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'seg_user';
    
    protected $fillable = [
        'id','name','email','password','active','login','ip','stores','products','account','rol_id',          
    ];
    
   
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function setPasswordAttribute($password){
        $this->attributes['password'] = \Hash::make($password);
    }
    
    public function profile(){
        return $this->hasOne('App\Core\Security\UserProfile');
    }
    
    public function userAplications(){
        return $this->hasMany('App\Core\Security\AppUser');
    }
}

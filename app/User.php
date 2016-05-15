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
    protected $fillable = [
        'name', 'email', 'username', 'password', 'accountType',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function User_Detail(){

        return $this->hasOne('App\Models\User_Detail');
    } 

    public function Order(){

        return $this->hasMany('App\Models\Order');
    }     

    public function Checkout(){

        return $this->hasMany('App\Models\Checkout');
    }          

}

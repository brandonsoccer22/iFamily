<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password','family_id','is_parent','is_admin','is_hidden'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public static function getFamily($family_id){
        $params = [$family_id];
        $sql = "SELECT id,name,email,is_parent
                FROM users
                WHERE family_id = ?";
       
        $rs = \DB::select($sql, $params);

        return json_decode(json_encode($rs), true);
    }
}

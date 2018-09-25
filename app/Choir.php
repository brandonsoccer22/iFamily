<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choir extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','created_by', 'name', 'repeat','note','is_static'
    ];
    
}

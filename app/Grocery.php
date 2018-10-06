<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grocery extends Model
{
	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	 protected $fillable = [
	 	'created_by', 'name', 'description', 'type', 'from', 'done_by'
	 ];
	}

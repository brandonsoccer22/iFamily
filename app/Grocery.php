<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grocery extends Model
{
    public function scopeUndone($query)
    {
    	return $query->where('status', 0);
    }
    public function scopeOftype($query, $type)
    {
    	return $query->where('type', $type);
    }
}

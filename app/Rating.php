<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
	protected $guarded = ['id'];
	
    public function movies()
    {
    	return $this->belongsTo(Movie::class);
    }
}

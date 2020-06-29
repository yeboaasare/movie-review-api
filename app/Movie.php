<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
	protected $guarded = ['id'];
	protected $softDelete = true;

    public function user()
    {
    	return $this->belongsTo(User::class);
    }


    public function ratings()
    {
    	return $this->hasMany(Rating::class);
    }
}

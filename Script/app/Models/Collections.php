<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collections extends Model
{
	protected $guarded = [];
	
	public function user()
	{
		return $this->belongsTo(User::class)->first();
	}

	public function collectionImages()
	{
		return $this->hasMany(CollectionsImages::class)->orderBy('id','desc');
	}



}

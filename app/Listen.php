<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listen extends Model
{
	protected $table = 'music_listens';
	protected $primaryKey = 'id';
	public $timestamps = false;
	protected $fillable = [
		'music_id',
		'listen'
	];

	public function music() {
		return $this->belongsTo(Music::class,'music_id','id');
	}
}

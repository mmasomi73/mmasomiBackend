<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $table = 'musics';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
    	'src',
    	'title',
    	'artist',
    	'cover',
    	'link'
    ];

	public function listen() {
		return $this->hasOne(Listen::class,'music_id','id');
    }

}

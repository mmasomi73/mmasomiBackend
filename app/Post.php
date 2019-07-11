<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * Class Post
 * @package App
 */
class Post extends Model
{
	use Notifiable,SoftDeletes;

	public $table = 'posts';
	public $primaryKey = 'id';
	protected $dates = ['deleted_at'];
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
		'post',
		'back_post',
		'cover',
		'photo',
		'published_at',
		'deleted_at',
	];
}

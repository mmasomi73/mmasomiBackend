<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'family',
        'username',
        'email',
        'password',
        'status',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * admin api token
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function token()
    {
        return $this->hasOne (UserToken::class,'user_id','id');
    }

    /**
     * post relation, each user can send many posts
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function  posts()
    {
        return $this->hasMany (Post::class,'user_id','id');
    }
}

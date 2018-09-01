<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Admin
 * @package App
 */
class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'family',
        'username',
        'email',
        'password',
        'status',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * admin api token
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function token()
    {
        return $this->hasOne (AdminToken::class,'admin_id','id');
    }
}

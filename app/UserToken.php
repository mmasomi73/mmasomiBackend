<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserToken
 * @package App
 */
class UserToken extends Model
{
    protected $table = 'users_token';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'token',
    ];

    protected $hidden = [
        'token',
    ];

    /**
     * user relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo (User::class,'user_id','id');
    }
}

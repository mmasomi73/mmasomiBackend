<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminToken
 * @package App
 */
class AdminToken extends Model
{
    protected $table = 'admins_token';
    protected $primaryKey = 'id';
    protected $fillable = [
        'admin_id',
        'token',
    ];

    protected $hidden = [
        'token',
    ];

    /**
     * admin relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo (Admin::class,'admin_id','id');
    }
}

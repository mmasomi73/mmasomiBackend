<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 * @package App
 */
class Notification extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'message',
        'publish_at',
        'status',
    ];


}

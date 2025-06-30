<?php

namespace Modules\Notification\Entities;

use Modules\Core\Entities\BaseModel;

class NotificationDriver extends BaseModel
{
    protected $fillable = [
        'driver',
        'token',
    ];

    public function notifable()
    {
        return $this->morphTo();
    }
}

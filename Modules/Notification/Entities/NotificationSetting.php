<?php

namespace Modules\Notification\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;

class NotificationSetting extends BaseModel
{
    protected $fillable = [
        'user_id',
        'enabled',
        'template_id',
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->belongsTo(NotificationTemplate::class);
    }
}

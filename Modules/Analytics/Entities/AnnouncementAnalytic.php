<?php

namespace Modules\Analytics\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;
use Modules\Announcements\Entities\Announcement;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnnouncementAnalytic extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'announcement_id',
        'viewer_id',
        'action_type',
        'count',
        'ip_address',
        'call_type',
    ];

    public const ACTION_TYPES = [
        'view',
        'call_press'
    ];

    public const CALL_TYPES = [
        'phone',
        'whatsapp',
    ];

    protected $casts = [
        'count' => 'integer',
    ];
    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }

    public function viewer()
    {
        return $this->belongsTo(User::class, 'viewer_id');
    }
}

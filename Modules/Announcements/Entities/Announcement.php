<?php

namespace Modules\Announcements\Entities;

use App\Models\User;
use Modules\Analytics\Entities\AnnouncementAnalytic;
use Modules\Core\Entities\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends BaseModel
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'sub_category_id',
        'user_id',
        'metadata',
        'city',
    ];

    protected $casts = [
        'metadata' => 'array',
        'price' => 'float',
    ];

    public function category()
    {
        return $this->belongsTo(AnnouncementCategory::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(AnnouncementCategory::class, 'sub_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function analytics()
    {
        return $this->hasMany(AnnouncementAnalytic::class);
    }

    public function views()
    {
        return $this->analytics()->where('action_type', 'view');
    }

    public function calls()
    {
        return $this->analytics()->where('action_type', 'call_press');
    }
}

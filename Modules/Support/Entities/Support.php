<?php

namespace Modules\Support\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Support extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'email',
        'phone_number',
        'subject',
        'message',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(SupportCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

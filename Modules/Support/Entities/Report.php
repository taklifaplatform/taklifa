<?php

namespace Modules\Support\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reason_id',
        'message',
        'status',
        'reportable_id',
        'reportable_type',
    ];

    public function reason()
    {
        return $this->belongsTo(ReportReason::class, 'reason_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reportable()
    {
        return $this->morphTo();
    }
}

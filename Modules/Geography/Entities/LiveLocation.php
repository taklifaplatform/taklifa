<?php

namespace Modules\Geography\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;

class LiveLocation extends BaseModel
{

    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

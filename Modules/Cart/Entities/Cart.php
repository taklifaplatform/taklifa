<?php

namespace Modules\Cart\Entities;

use App\Models\User;
use Modules\Company\Entities\Company;
use Modules\Core\Entities\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'device_identifier',
        'company_id',
        'total_items',
        'total_cost',
    ];

    protected $casts = [
        'total_cost' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

}

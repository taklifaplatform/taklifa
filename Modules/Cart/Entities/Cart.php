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
        'code',
        'total_items',
        'total_cost',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function items()
    {
        return $this->hasMany(CartItem::class);
    }


    public function updateTotals(): void
    {
        $this->load('items'); // ensure fresh data
        $this->update([
            'total_items' => $this->items->sum('quantity'),
            'total_cost' => $this->items->sum('total_price'),
        ]);
    }
}

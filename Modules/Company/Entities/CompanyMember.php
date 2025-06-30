<?php

namespace Modules\Company\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modules\Company\Entities\CompanyMember
 */
class CompanyMember extends BaseModel
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'company_id',
        'user_id',
        'role',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

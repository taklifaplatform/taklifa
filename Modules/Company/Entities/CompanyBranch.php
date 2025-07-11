<?php

namespace Modules\Company\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;
use Modules\Geography\Entities\Location;

class CompanyBranch extends BaseModel
{

    protected $fillable = [
        'contact_number',
        'name',
        'description',
        'company_id',
        'creator_id',

    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}

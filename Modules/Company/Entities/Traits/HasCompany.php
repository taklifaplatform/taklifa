<?php

namespace Modules\Company\Entities\Traits;

use Modules\Company\Entities\Company;
use Modules\Company\Entities\CompanyMember;

trait HasCompany
{
    public function companies()
    {
        return $this->hasManyThrough(Company::class, CompanyMember::class, 'user_id', 'id', 'id', 'company_id');
    }

    public function activeCompany()
    {
        return $this->companies()->where('id', $this->active_company_id)->first();
    }
}

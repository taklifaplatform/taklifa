<?php

namespace Modules\User\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Company\Transformers\SimpleCompanyTransformer;
use Modules\Core\Transformers\JsonTransformer;
use Modules\Core\Transformers\MediaTransformer;

class AuthenticatedUserTransformer extends JsonTransformer
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'phone_number_verified_at' => $this->phone_number_verified_at,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'latest_activity' => $this->latest_activity,

            'about' => $this->about,

            'roles' => UserSimpleRoleTransformer::collection($this->roles),
            'active_role' => UserSimpleRoleTransformer::make($this->activeRole),
            'verification_status' => $this->verification?->verification_status,

            'companies' => SimpleCompanyTransformer::collection($this->companies),
            'active_company' => SimpleCompanyTransformer::make($this->activeCompany),

            'avatar' => MediaTransformer::make($this->getFirstMedia('avatar')),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('AuthenticatedUserTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('username')->required(),
                Schema::string('name')->required(),
                Schema::string('phone_number')->required(),
                Schema::string('email')->required(),
                Schema::string('email_verified_at')->required(),

                Schema::string('verification_status')->required(),


                Schema::string('about')->required(),

                Schema::array('roles')->items(
                    Schema::ref('#/components/schemas/UserSimpleRoleTransformer'),
                ),
                Schema::ref('#/components/schemas/UserSimpleRoleTransformer', 'active_role'),

                Schema::array('companies')->items(
                    Schema::ref('#/components/schemas/SimpleCompanyTransformer'),
                ),
                Schema::ref('#/components/schemas/SimpleCompanyTransformer', 'active_company'),

                Schema::ref('#/components/schemas/MediaTransformer', 'avatar'),
            );
    }
}

<?php

namespace Modules\Company\Transformers;

use App\Models\User;
use Modules\Core\Transformers\JsonTransformer;
use Modules\User\Transformers\UserTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class CompanyInvitationTransformer extends JsonTransformer
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $existingUser = null;
        if ($this->email) {
            $existingUser = User::where('email', $this->email)->first();
        }
        if (!$existingUser && $this->phone_number) {
            $existingUser = User::where('phone_number', $this->phone_number)->first();
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'role' => $this->role,
            'phone_number' => $this->phone_number,
            'email' => $this->email,

            'company' => SimpleCompanyTransformer::make($this->company),

            'existing_user' => UserTransformer::make($existingUser),
            'sender' => UserTransformer::make($this->sender),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('CompanyInvitationTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('name')->required(),
                Schema::string('role')->required(),
                Schema::string('phone_number')->required(),
                Schema::string('email')->required(),

                Schema::ref('#/components/schemas/SimpleCompanyTransformer', 'company'),
                Schema::ref('#/components/schemas/UserTransformer', 'existing_user'),
                Schema::ref('#/components/schemas/UserTransformer', 'sender'),
            );
    }
}

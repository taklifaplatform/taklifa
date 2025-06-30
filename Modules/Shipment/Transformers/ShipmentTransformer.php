<?php

namespace Modules\Shipment\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;
use Modules\Geography\Transformers\LocationTransformer;
use Modules\Geography\Transformers\PriceTransformer;
use Modules\User\Transformers\UserTransformer;

class ShipmentTransformer extends JsonTransformer
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
            'code' => $this->code,
            'user' => UserTransformer::make($this->user),
            'from_location_id' => $this->from_location_id,
            'from_location' => LocationTransformer::make($this->fromLocation),
            'to_location_id' => $this->to_location_id,
            'to_location' => LocationTransformer::make($this->toLocation),

            'pick_date' => $this->pick_date,
            'pick_time' => $this->pick_time,
            'deliver_date' => $this->deliver_date,
            'deliver_time' => $this->deliver_time,
            'recipient_name' => $this->recipient_name,
            'recipient_phone' => $this->recipient_phone,
            'items_type' => $this->items_type,
            'status' => $this->status,
            'active_contract_id' => $this->active_contract_id,


            'selected_driver_id' => $this->selected_driver_id,
            'selected_company_id' => $this->selected_company_id,

            'min_budget' => PriceTransformer::make($this->minBudget),
            'max_budget' => PriceTransformer::make($this->maxBudget),

            'items' => ShipmentItemTransformer::collection($this->items),

            'invitations_count' => $this->invitations->count(),
            'pending_invitations_count' => $this->pendingInvitations->count(),
            'proposals_count' => $this->proposals->count(),
            'accepted_proposals_count' => $this->acceptedProposals->count(),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ShipmentTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('code')->nullable(),
                Schema::string('pick_date')->nullable(),
                Schema::string('pick_time')->nullable(),
                Schema::string('deliver_date')->nullable(),
                Schema::string('deliver_time')->nullable(),
                Schema::string('recipient_name')->nullable(),
                Schema::string('recipient_phone')->nullable(),

                Schema::string('selected_driver_id')->nullable(),
                Schema::string('selected_company_id')->nullable(),

                Schema::string('items_type')->enum([
                    'document',
                    'box',
                    'multiple_boxes',
                    'other',
                ])->default('document'),
                Schema::string('status')->enum([
                    'draft',
                    'searching',
                    'assigned',
                    'delivering',
                    'delivered',
                    'cancelled',
                    'pending',
                    'expired',
                    'rejected',
                    'completed',
                    'failed',
                    'returned',
                    'lost',
                    'damaged',
                    'stolen',
                    'other',
                ])->default('draft'),

                Schema::string('active_contract_id'),

                Schema::ref('#/components/schemas/UserTransformer', 'user'),
                Schema::ref('#/components/schemas/LocationTransformer', 'from_location'),
                Schema::ref('#/components/schemas/LocationTransformer', 'to_location'),
                Schema::ref('#/components/schemas/PriceTransformer', 'min_budget'),
                Schema::ref('#/components/schemas/PriceTransformer', 'max_budget'),

                Schema::array('items')->items(
                    Schema::ref('#/components/schemas/ShipmentItemTransformer')
                ),

                Schema::integer('invitations_count'),
                Schema::integer('pending_invitations_count'),

                Schema::integer('proposals_count'),
                Schema::integer('accepted_proposals_count'),

                Schema::string('created_at')->format(Schema::FORMAT_DATE_TIME),
                Schema::string('updated_at')->format(Schema::FORMAT_DATE_TIME),
            );
    }
}

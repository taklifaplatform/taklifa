<?php

namespace Modules\Shipment\ShipmentHelper;

use App\Models\User;
use Modules\Shipment\Entities\Shipment;
use Modules\Shipment\Entities\ShipmentContract;
use Modules\Shipment\Entities\ShipmentProposal;
use Modules\Shipment\Entities\ShipmentInvitation;
use Modules\Notification\Jobs\SendNotificationJob;
use Modules\Shipment\Jobs\SentShipmentInvitationsJob;
use Modules\Shipment\Notifications\ShipmentNewProposalNotification;
use Modules\Shipment\Notifications\ShipmentInvitationAcceptedNotification;
use Modules\Shipment\Notifications\ShipmentInvitationDeclinedNotification;

class ShipmentHelper
{
    public User $authUser;
    public ShipmentInvitation $invitation;

    public function __construct(
        public Shipment $shipment
    ) {
        if (auth()->id()) {
            $authUser = User::find(auth()->id());
            if ($authUser) {
                $this->authUser = $authUser;
            }
        }
    }

    public function setAuthUser(User $user): ShipmentHelper
    {
        $this->authUser = $user;

        return $this;
    }

    /**
     * Retrieve the refreshed shipment.
     */
    public function get(): Shipment
    {
        return $this->shipment->refresh();
    }

    public function confirmShipment(): ShipmentHelper
    {
        $this->canManageShipment();

        $this->generateShipmentCode();
        $this->notifyRecipients();
        $this->notifiyInvitedProviders();


        $shipment = $this->shipment;

        SentShipmentInvitationsJob::dispatch($this->get());

        if ($shipment->status === Shipment::STATUS_DRAFT) {
            $shipment->status = Shipment::STATUS_SEARCHING;
            $shipment->save();
        }

        return $this;
    }

    public function notifiyInvitedProviders(): ShipmentHelper
    {
        $invitations = $this->shipment->invitations()->where('status', ShipmentInvitation::STATUS_PENDING)->get();
        foreach ($invitations as $invitation) {
            if ($invitation->driver_id) {
                SendNotificationJob::dispatch(
                    type: \Modules\Notification\Entities\NotificationTemplate::TYPE_DRIVER_SHIPMENT_NEW_INVITATION_NOTIFICATION,
                    recipient: $invitation->driver,
                    sender: $this->shipment->user,
                    model: $this->shipment,
                    shipment: $this->shipment,
                );
            }

            if ($invitation->company_id) {
                foreach ($invitation->company->managers as $manager) {
                    SendNotificationJob::dispatch(
                        type: \Modules\Notification\Entities\NotificationTemplate::TYPE_COMPANY_MANAGER_SHIPMENT_NEW_INVITATION_NOTIFICATION,
                        recipient: $manager,
                        sender: $this->shipment->user,
                        model: $this->shipment,
                        shipment: $this->shipment,
                    );
                }
            }
        }
        return $this;
    }

    public function notifyRecipients(): ShipmentHelper
    {
        if (!$this->shipment->should_notify_customer) {
            return $this;
        }

        $customer = User::where('phone_number', $this->shipment->recipient_phone)->first();

        if (!$customer) {
            $customer = new User();
            $customer->username = $this->shipment->recipient_phone . '_' . $this->shipment->recipient_name;
            $customer->password = bcrypt($this->shipment->recipient_phone . '_' . $this->shipment->recipient_name);
            $customer->name = $this->shipment->recipient_name;
            $customer->phone_number = $this->shipment->recipient_phone;
            $customer->save();
        } else {
            if (!$customer->name) {
                $customer->name = $this->shipment->recipient_name;
                $customer->save();
            }
        }

        SendNotificationJob::dispatch(
            type: \Modules\Notification\Entities\NotificationTemplate::TYPE_NOTIFY_CUSTOMER_SHIPMENT_CONFIRMED,
            recipient: $customer,
            sender: $this->shipment->user,
            model: $this->shipment,
            shipment: $this->shipment,
        );
        return $this;
    }

    public function generateShipmentCode($range = 99): ShipmentHelper
    {
        if ($this->shipment->code) {
            return $this;
        }

        $shipment = $this->shipment;

        // Code example: SW{FROM_COUNTRY_CODE}{MONTH}{DAY}{TO_COUNTRY_CODE}{MONTH}{DAY}{TO_COUNTRY_CODE}{SENDER_NAME_2D}{random_number}{RECIPIENT_2D}
        $fromCountryCode = $shipment->fromLocation?->country?->code;
        $toCountryCode = $shipment->toLocation?->country?->code;
        $pickDate = $shipment->pick_date;
        $deliverDate = $shipment->deliver_date;

        $code = 'SW' . $fromCountryCode . $pickDate->format('md') . $toCountryCode . $deliverDate->format('md') . rand((int) $range / 2, $range);

        $capitalCode = strtoupper($code);

        if (Shipment::where('code', $capitalCode)->exists()) {
            return $this->generateShipmentCode(
                $range * 10
            );
        }

        $shipment->code = $capitalCode;
        $shipment->handshake_code = $capitalCode . '-' . $shipment->user->id . '-' . $shipment->id;
        $shipment->save();

        return $this;
    }

    public function canManageShipment(): bool
    {
        if (
            $this->shipment->user_id !== $this->authUser->id
        ) {
            abort(403, 'You are not allowed to manage this shipment.');
        }

        return true;
    }

    public function getCurrentProviderPendingInvitation(): ShipmentInvitation | null
    {
        if ($this->authUser->active_company_id) {
            return $this->shipment->invitations()
                ->where('status', ShipmentInvitation::STATUS_PENDING)
                ->where('company_id', $this->authUser->active_company_id)
                ->first();
        }


        return $this->shipment->invitations()
            ->where('status', ShipmentInvitation::STATUS_PENDING)
            ->where('driver_id', $this->authUser->id)
            ->first();
    }

    public function canAcceptInvitation(ShipmentInvitation $shipmentInvitation): bool
    {
        if (
            $shipmentInvitation->driver_id !== $this->authUser->id
            && !$this->authUser->companies()->find($shipmentInvitation->company_id)
        ) {
            abort(403, 'You are not allowed to accept this invitation.');
        }

        return true;
    }

    public function canModifyInvitation(ShipmentInvitation $shipmentInvitation): bool
    {
        if ($shipmentInvitation->shipment->user_id !== $this->authUser->id) {
            abort(403, 'You are not allowed to modify this invitation.');
        }

        return true;
    }

    public function setActiveInvitation(ShipmentInvitation $shipmentInvitation): ShipmentHelper
    {
        $this->invitation = $shipmentInvitation;

        return $this;
    }

    public function acceptInvitation(
        ShipmentInvitation $shipmentInvitation,
    ): ShipmentHelper {
        if (!$this->canAcceptInvitation($shipmentInvitation)) {
            return $this;
        }
        $this->setActiveInvitation($shipmentInvitation);

        if ($shipmentInvitation->status !== ShipmentInvitation::STATUS_ACCEPTED) {
            $this->shipment->user->notify(
                new ShipmentInvitationAcceptedNotification(
                    $this->shipment,
                    $shipmentInvitation
                )
            );
        }

        $shipmentInvitation->update([
            'status' => ShipmentInvitation::STATUS_ACCEPTED,
        ]);

        return $this;
    }

    public function declineInvitation(ShipmentInvitation $shipmentInvitation): ShipmentHelper
    {
        if (!$this->canAcceptInvitation($shipmentInvitation)) {
            return $this;
        }

        $this->setActiveInvitation($shipmentInvitation);

        if ($shipmentInvitation->status === ShipmentInvitation::STATUS_DECLINED) {
            return $this;
        }

        $shipmentInvitation->update([
            'status' => ShipmentInvitation::STATUS_DECLINED,
        ]);

        $this->shipment->user->notify(
            new ShipmentInvitationDeclinedNotification(
                $this->shipment,
                $shipmentInvitation
            )
        );

        return $this;
    }

    public function removeInvitation(ShipmentInvitation $shipmentInvitation): ShipmentHelper
    {
        if (!$this->canManageShipment()) {
            return $this;
        }

        // TODO:: remove related notification & chat threads
        $shipmentInvitation->delete();
        return $this;
    }

    public function getCurrentProviderProposal(): ShipmentProposal | null
    {
        if ($this->authUser->active_company_id) {
            return $this->shipment->proposals()
                ->where('company_id', $this->authUser->active_company_id)
                ->first();
        }


        return $this->shipment->proposals()
            ->where('driver_id', $this->authUser->id)
            ->first();
    }

    /**
     * Determines if the current user can modify a shipment proposal.
     *
     * @param  ShipmentProposal  $proposal  The shipment proposal to check.
     * @return bool Returns true if the user can modify the proposal, false otherwise.
     */
    public function canModifyProposal(ShipmentProposal $proposal): bool
    {
        if ($proposal->user_id !== $this->authUser->id) {
            abort(403, 'You are not allowed to modify this proposal.');
        }

        return true;
    }

    /**
     * Determines if the current user can modify a shipment proposal.
     *
     * @return bool Returns true if the user can modify the proposal, false otherwise.
     */
    public function canSubmitProposal(): bool
    {
        if ($this->shipment->user_id === $this->authUser->id) {
            return false;
        }

        if (
            $this->shipment->proposals()
            ->where('driver_id', $this->authUser->id)
            ->exists()
        ) {
            return false;
        }

        if (
            $this->authUser->active_company_id &&
            $this->shipment->proposals()
            ->where('company_id', $this->authUser->active_company_id)
            ->exists()
        ) {
            return false;
        }

        return true;
    }

    /**
     * Determines if the current user can modify a shipment proposal.
     *
     * @param  ShipmentProposal  $proposal  The shipment proposal to check.
     * @return bool Returns true if the user can modify the proposal, false otherwise.
     */
    public function canAcceptProposal(ShipmentProposal $proposal): bool
    {
        if ($proposal->shipment->user_id !== $this->authUser->id) {
            abort(403, 'You are not allowed to accept this proposal.');
        }

        return true;
    }


    /**
     * Determines if the current user can modify a shipment proposal.
     *
     * @param  ShipmentProposal  $proposal  The shipment proposal to check.
     * @return bool Returns true if the user can modify the proposal, false otherwise.
     */
    public function canEditProposal(ShipmentProposal $proposal): bool
    {
        if (
            $proposal->driver_id !== $this->authUser->id
            && !$this->authUser->companies()->find($proposal->company_id)
        ) {
            abort(403, 'You are not allowed to edit this proposal.');
        }

        return true;
    }

    public function handleNewProposal(
        ShipmentProposal $proposal
    ): ShipmentHelper {

        // notify customer, that the invitation has been accepted and there's new proposal
        $this->shipment->user->notify(
            new ShipmentNewProposalNotification(
                $this->shipment,
                $proposal
            )
        );

        if ($this->invitation) {
            $proposal->invitation_id = $this->invitation->id;
            $proposal->save();
        }

        return $this->createProposalChannel($proposal);
    }

    /**
     * Accepts a shipment proposal.
     *
     * @param  ShipmentProposal  $proposal  The shipment proposal to accept.
     * @return ShipmentHelper The updated ShipmentHelper instance.
     */
    public function acceptProposal(
        ShipmentProposal $proposal
    ): ShipmentHelper {

        if (!$this->canAcceptProposal($proposal)) {
            return $this;
        }

        $proposal->update([
            'status' => ShipmentProposal::STATUS_ACCEPTED,
        ]);

        $proposal->channel?->messages()->create([
            'user_id' => $this->shipment->user_id,
            'text' => $this->shipment->user->name . ' accepted the offer.',
            'type' => 'system',
        ]);

        return $this;
    }

    /**
     * Accepts a shipment proposal.
     *
     * @param  ShipmentProposal  $proposal  The shipment proposal to accept.
     * @return ShipmentHelper The updated ShipmentHelper instance.
     */
    public function createProposalContract(
        ShipmentProposal $proposal
    ): ShipmentHelper {

        if (!$this->canAcceptProposal($proposal)) {
            return $this;
        }

        if ($this->shipment->active_contract_id) {
            return $this;
        }

        $contract = ShipmentContract::create([
            'shipment_id' => $proposal->shipment_id,
            'proposal_id' => $proposal->id,
            'driver_id' => $proposal->driver_id,
            'company_id' => $proposal->company_id,
            'total_cost_id' => $proposal->total_cost_id,
            'fee_id' => $proposal->fee_id,
            'channel_id' => $proposal->channel_id,
        ]);

        $shipment = $this->shipment;

        $shipment->status = Shipment::STATUS_ASSIGNED;
        $shipment->active_contract_id = $contract->id;
        $shipment->save();

        $proposal->locked = true;
        $proposal->save();

        $proposal->update([
            'status' => ShipmentProposal::STATUS_HIRED,
        ]);

        $proposal->channel?->messages()->create([
            'user_id' => $this->shipment->user_id,
            'text' => $this->shipment->user->name . ' started new contract.',
            'type' => 'system',
        ]);

        return $this;
    }

    public function cancelContract(ShipmentContract $shipmentContract): ShipmentHelper
    {
        $shipment = $this->shipment;

        if ($shipment->status === Shipment::STATUS_CANCELLED) {
            return $this;
        }

        if ($shipment->id !== $shipmentContract->shipment_id) {
            abort(403, 'You are not allowed to cancel this contract.');
        }

        $shipmentContract->status = ShipmentContract::STATUS_CANCELED;
        $shipmentContract->save();

        // make sure the current user can cancel the contract
        // TODO: @badi

        $shipment->status = Shipment::STATUS_CANCELLED;
        $shipment->save();

        $shipmentContract->channel?->messages()->create([
            'user_id' => $this->authUser->id,
            'text' => $this->authUser->name . ' cancelled the contract.',
            'type' => 'system',
        ]);


        // TODO: send notification to the driver

        return $this;
    }

    /**
     * Declines a shipment proposal.
     *
     * @param  ShipmentProposal  $proposal  The shipment proposal to decline.
     * @return ShipmentHelper The updated ShipmentHelper instance.
     */
    public function declineProposal(
        ShipmentProposal $proposal
    ): ShipmentHelper {

        if (!$this->canAcceptProposal($proposal)) {
            return $this;
        }

        $proposal->update([
            'status' => ShipmentProposal::STATUS_DECLINED,
        ]);

        $proposal->channel->messages()->create([
            'user_id' => $this->shipment->user_id,
            'text' => $this->shipment->user->name . ' declined the offer.',
            'type' => 'system',
        ]);

        return $this;
    }

    /**
     * Creates a proposal channel for a shipment proposal.
     *
     * @param  ShipmentProposal  $proposal  The shipment proposal to create a channel for.
     * @return ShipmentHelper Returns the instance of the ShipmentHelper class.
     */
    public function createProposalChannel(
        ShipmentProposal $proposal
    ): ShipmentHelper {

        // if (!$this->canAcceptProposal($proposal)) {
        //     return $this;
        // }

        if (!$proposal) {
            return $this;
        }

        if ($proposal->channel_id && $proposal->channel) {
            return $this;
        }

        $channel = $proposal->channel()->create([
            'name' => $this->shipment->code, // TODO: Add channel name
            'creator_id' => $this->authUser->id,
        ]);

        $proposal->update([
            'channel_id' => $channel->id,
        ]);

        $channel->members()->create([
            'user_id' => $this->shipment->user_id,
            'role' => 'admin',
        ]);

        if ($proposal->driver_id) {
            $channel->members()->create([
                'user_id' => $proposal->driver_id,
                'role' => 'user',
            ]);

            $channel->name = $channel->name . ' - ' . $proposal->driver->name;

            $message = $channel->messages()->create([
                'user_id' => $this->authUser->id,
                'text' => $this->authUser->name . ' created an offer for ' . $this->shipment->user->name . ' shipment.',
                'type' => 'system',
            ]);

            $message->created_at = $proposal->created_at;
            $message->save();
        }

        if ($proposal->company_id) {
            foreach ($proposal->company->members as $member) {
                $channel->members()->create([
                    'user_id' => $member->user_id,
                    'role' => 'user',
                ]);
            }

            $channel->name = $channel->name . ' - ' . $proposal->company->name;

            $message = $channel->messages()->create([
                'user_id' => $this->authUser->id,
                'text' => $this->authUser->name . ' created an offer for ' . $this->shipment->user->name . ' shipment, on behalf of ' . $proposal->company->name,
                'type' => 'system',
            ]);

            $message->created_at = $proposal->created_at;
            $message->save();
        }

        $channel->save();

        $channel->messages()->create([
            'user_id' => $this->authUser->id,
            'text' => $proposal->message,
        ]);

        return $this;
    }
}

<?php

namespace Modules\Shipment\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Shipment\Entities\Shipment;
use Modules\Shipment\Notifications\CompanyManagerShipmentNewInvitationNotification;
use Modules\Shipment\Notifications\DriverShipmentNewInvitationNotification;

class SentShipmentInvitationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public Shipment $shipment
    ) {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $invitations = $this->shipment->invitations()->where('notification_sent', false)->get();

        foreach ($invitations as $invitation) {
            if ($invitation->driver_id) {
                $invitation->driver->notify(
                    new DriverShipmentNewInvitationNotification(
                        shipment: $this->shipment
                    )
                );
            }

            if ($invitation->company_id) {
                $company = $invitation->company;

                $company->managers->each(function ($manager) use ($company) {
                    $manager->user?->notify(
                        new CompanyManagerShipmentNewInvitationNotification(
                            shipment: $this->shipment,
                            company: $company
                        )
                    );
                });
            }

            $company->notification_sent = true;
            $company->save();
        }
    }
}

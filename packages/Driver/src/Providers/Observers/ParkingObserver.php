<?php

namespace Driver\Providers\Observers;

use App\Constants\Notifications\ModulesEvents\NotificationParkingEvent;
use App\Constants\Notifications\NotificationParentModule;
use App\Models\Parking;
use App\Traits\NotificationTrait;
use Carbon\Carbon;

class ParkingObserver
{

    use NotificationTrait;

    public $recepient_tokens = [];

    public function created(Parking $parking)
    {
        $this->appendRecepientTokens($parking->user->notificationTokens);

        if ($parking->driver) {

            $this->appendRecepientTokens($parking->driver->notificationTokens);
        }

        $data = [
            'recipients' => $this->recepient_tokens,
            'event_id' => $parking->id,
            'actor_id' => auth()->id(),
            'occurred_at' => Carbon::now(),
            'content_data' => [
                'PARKING_ID' => $parking->id,
                'DRIVER_ID' => $parking->driver ? $parking->driver->id : '',
                'DRIVER_NAME' => $parking->driver ? $parking->driver->name : '',
                'CUSTOMER_ID' => $parking->user->id,
                'CUSTOMER_NAME' => $parking->user->name,
            ]
        ];

        $this->notify(
            NotificationParentModule::PARKING,
            NotificationParkingEvent::START_PARKINK,
            $data
        );
    }

    public function updated(Parking $parking)
    {
        $this->appendRecepientTokens($parking->user->notificationTokens);

        if ($parking->driver) {

            $this->appendRecepientTokens($parking->driver->notificationTokens);
        }

        $data = [
            'recipients' => $this->recepient_tokens,
            'event_id' => $parking->id,
            'actor_id' => auth()->id(),
            'occurred_at' => Carbon::now(),
            'content_data' => [
                'PARKING_ID' => $parking->id,
                'DRIVER_ID' => $parking->driver ? $parking->driver->id : '',
                'DRIVER_NAME' => $parking->driver ? $parking->driver->name : '',
                'CUSTOMER_ID' => $parking->user->id,
                'CUSTOMER_NAME' => $parking->user->name,
            ]
        ];

        if ($parking->wasChanged('start_confirmed_at')) {

            $data['recipients'] = $this->recepient_tokens;

            $this->notify(
                NotificationParentModule::PARKING,
                NotificationParkingEvent::CONFIRM_START_PARKINK,
                $data
            );
        }

        if ($parking->wasChanged('ends_at')) {

            $data['recipients'] = $this->recepient_tokens;

            $this->notify(
                NotificationParentModule::PARKING,
                NotificationParkingEvent::END_PARKINK,
                $data
            );
        }
    }

    private function recepientTokens($recepients)
    {

        foreach ($recepients as $recipient) {

            $this->appendRecepientTokens($recipient->notificationTokens);
        }
    }

    private function appendRecepientTokens($notificationTokens)
    {
        foreach ($notificationTokens as $token_obj) {

            array_push($this->recepient_tokens, $token_obj);
        };
    }
}

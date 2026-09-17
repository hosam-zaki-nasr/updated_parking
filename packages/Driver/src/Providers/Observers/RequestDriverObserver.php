<?php

namespace Driver\Providers\Observers;

use App\Constants\GeneralBooleanStatus;
use App\Constants\HasLookupType\RequestDriverStatus;
use App\Constants\HasLookupType\RequestDriverTypes;
use App\Constants\Notifications\ModulesEvents\NotificationParkingEvent;
use App\Constants\Notifications\NotificationParentModule;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\RequestDriver;
use App\Models\User;
use App\Traits\NotificationTrait;
use Carbon\Carbon;

class RequestDriverObserver
{

    use NotificationTrait;

    public $recepient_tokens = [];

    public function created(RequestDriver $requestDriver)
    {
        $recepient_users = User::where([
            'account_type_id' => AccountTypeCollection::driver()->id,
            'garage_id' => $requestDriver->garage_id,
            'notification_status' => GeneralBooleanStatus::ON['code']
        ])
            ->with('notificationTokens')
            ->get();

        $data = [
            'recipients' => $this->recepient_tokens,
            'event_id' => $requestDriver->id,
            'actor_id' => auth()->id(),
            'occurred_at' => Carbon::now(),
            'content_data' => [
                'CUSTOMER_ID' => $requestDriver->user ? $requestDriver->user->id : '',
                'CUSTOMER_NAME' => $requestDriver->user ? $requestDriver->user->name : '',
                'DRIVER_ID' => $requestDriver->driver ? $requestDriver->driver->id : '',
                'DRIVER_NAME' => $requestDriver->driver ? $requestDriver->driver->name : '',
                'REQUEST_DRIVER_ID' => $requestDriver->id,
                'REQUEST_DRIVER_TYPE_CODE' => $requestDriver->type->code,
                'REQUEST_DRIVER_TYPE_NAME' => $requestDriver->type->name,
                'REQUEST_DRIVER_TYPE_NAME_AR' => $requestDriver->type->name_ar,
            ]
        ];

        $this->appendRecepientTokens($requestDriver->user->notificationTokens);

        $this->recepientTokens($recepient_users);

        $data['recipients'] = $this->recepient_tokens;

        if ($requestDriver->type->code == RequestDriverTypes::START_PARKING['code']) {

            $this->notify(
                NotificationParentModule::REQUEST_DRIVER,
                NotificationParkingEvent::REQUEST_START_PARKING,
                $data,
            );
        } else {

            $this->notify(
                NotificationParentModule::REQUEST_DRIVER,
                NotificationParkingEvent::REQUEST_END_PARKING,
                $data,
            );
        }
    }

    public function updated(RequestDriver $requestDriver)
    {
        $recepient_drivers = User::where([
            'account_type_id' => AccountTypeCollection::driver()->id,
            'garage_id' => $requestDriver->garage_id,
            'notification_status' => GeneralBooleanStatus::ON['code']
        ])
            ->with('notificationTokens')
            ->get();

        $data = [
            'recipients' => $this->recepient_tokens,
            'event_id' => $requestDriver->id,
            'actor_id' => auth()->id(),
            'occurred_at' => Carbon::now(),
            'content_data' => [
                'CUSTOMER_ID' => $requestDriver->user ? $requestDriver->user->id : '',
                'CUSTOMER_NAME' => $requestDriver->user ? $requestDriver->user->name : '',
                'DRIVER_ID' => $requestDriver->driver ? $requestDriver->driver->id : '',
                'DRIVER_NAME' => $requestDriver->driver ? $requestDriver->driver->name : '',
                'CANCELER_NAME' => auth()->user()->name,
                'REQUEST_DRIVER_ID' => $requestDriver->id,
                'REQUEST_DRIVER_TYPE_CODE' => $requestDriver->type->code,
                'REQUEST_DRIVER_TYPE_NAME' => $requestDriver->type->name,
                'REQUEST_DRIVER_TYPE_NAME_AR' => $requestDriver->type->name_ar,
            ]
        ];

        if ($requestDriver->wasChanged('status_id')) {

            //Accepted by driver
            if ($requestDriver->status->code == RequestDriverStatus::ACCEPTED['code']) {

                $this->appendRecepientTokens($requestDriver->user->notificationTokens);

                if ($requestDriver->driver) {

                    $this->appendRecepientTokens($requestDriver->driver->notificationTokens);
                }

                $data['recipients'] = $this->recepient_tokens;

                $this->notify(
                    NotificationParentModule::REQUEST_DRIVER,
                    NotificationParkingEvent::ACCEPT_REQUEST_DRIVER,
                    $data
                );
            }

            //Canceled by customer
            if ($requestDriver->status->code == RequestDriverStatus::CANCELED['code']) {

                $this->appendRecepientTokens($requestDriver->user->notificationTokens);

                if ($requestDriver->driver) {

                    $this->appendRecepientTokens($requestDriver->driver->notificationTokens);
                }

                $data['recipients'] = $this->recepient_tokens;

                $this->notify(
                    NotificationParentModule::REQUEST_DRIVER,
                    NotificationParkingEvent::CANCELED_REQUEST_DRIVER,
                    $data,
                );
            }
        }

        //Resend request start parking by customer
        if ($requestDriver->wasChanged('repeated_times')) {

            $this->appendRecepientTokens($requestDriver->user->notificationTokens);

            $this->recepientTokens($recepient_drivers);

            $data['recipients'] = $this->recepient_tokens;

            $this->notify(
                NotificationParentModule::REQUEST_DRIVER,
                NotificationParkingEvent::REQUEST_START_PARKING,
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

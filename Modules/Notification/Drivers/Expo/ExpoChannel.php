<?php

namespace Modules\Notification\Drivers\Expo;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Notifications\Notification;
use Modules\Notification\Exceptions\CouldNotSendNotification;

class ExpoChannel
{
    /**
     * The Http Client.
     *
     * @var Client
     */
    protected $client;

    /**
     * Initialise a new Expo Push Channel instance.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     *
     * @throws CouldNotSendNotification|GuzzleException
     */
    public function send($notifiable, Notification $notification)
    {
        if (! ($to = $notifiable->routeNotificationFor('expo'))) {
            return;
            // throw CouldNotSendNotification::noValidDestination($notifiable);
        }

        if (! method_exists($notification, 'toExpo')) {
            throw CouldNotSendNotification::undefinedMethod($notification);
        }

        /** @var ExpoMessage $message */
        if (! ($message = $notification->toExpo($notifiable)) instanceof ExpoMessage) {
            throw CouldNotSendNotification::couldNotCreateMessage($notification);
        }

        if (! is_array($to)) {
            $to = [$to];
        }

        $messages = array_map(
            function ($recipient) use ($message) {
                return array_merge(['to' => $recipient], $message->toArray());
            },
            $to
        );

        try {
            $response = $this->client->request(
                'post',
                'https://exp.host/--/api/v2/push/send?useFcmV1=true',
                ['json' => $messages]
            );

            if ($response->getStatusCode() !== 200) {
                throw CouldNotSendNotification::serviceRespondedWithAnError($response);
            }

            return $response;
        } catch (ClientException $exception) {
            throw CouldNotSendNotification::clientError($exception);
        } catch (Exception $exception) {
            throw CouldNotSendNotification::unexpectedException($exception);
        }
    }
}

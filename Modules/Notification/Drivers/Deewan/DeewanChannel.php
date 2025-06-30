<?php

namespace Modules\Notification\Drivers\Deewan;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Notifications\Notification;
use Modules\Notification\Exceptions\CouldNotSendNotification;

class DeewanChannel
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
        if (! env('DEEWAN_API_KEY')) {
            throw CouldNotSendNotification::noApiKey($notifiable);
        }

        if (! ($to = $notifiable->routeNotificationFor('deewan'))) {
            throw CouldNotSendNotification::noValidDestination($notifiable);
        }

        if (! method_exists($notification, 'toDeewan')) {
            throw CouldNotSendNotification::undefinedMethod($notification, 'toDeewan');
        }

        /** @var DeewanMessage $message */
        if (! ($message = $notification->toDeewan($notifiable)) instanceof DeewanMessage) {
            throw CouldNotSendNotification::couldNotCreateMessage($notification, 'toDeewan');
        }

        if (is_array($to)) {
            $to = $to[0];
        }

        // $messages = array_map(
        //     function ($recipient) use ($message) {
        //         return array_merge(['to' => $recipient], $message->toArray());
        //     },
        //     $to
        // );

        try {
            $requestBody = [
                'senderName' => 'SAWAEED',
                'messageType' => 'text',
                'messageText' => $message->getText(),
                'recipients' => $to
            ];

            $response = $this->client->request(
                'post',
                'https://apis.deewan.sa/sms/v1/messages',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . env('DEEWAN_API_KEY'),
                        'accept' => 'application/json',
                        'content-type' => 'application/json',
                    ],
                    'json' => $requestBody
                ]
            );

            if ($response->getStatusCode() !== 200) {
                throw CouldNotSendNotification::serviceRespondedWithAnError($response, $message->getText());
            }

            return $response;
        } catch (ClientException $exception) {
            throw CouldNotSendNotification::clientError($exception);
        } catch (Exception $exception) {
            throw CouldNotSendNotification::unexpectedException($exception);
        }
    }
}

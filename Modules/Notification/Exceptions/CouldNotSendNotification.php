<?php

namespace Modules\Notification\Exceptions;

use Exception;
use GuzzleHttp\Exception\ClientException;

class CouldNotSendNotification extends \Exception
{
    /**
     * Expo responded with an error.
     *
     * @return static
     */
    public static function serviceRespondedWithAnError($response, $message = null)
    {
        $errorMessage = 'Expo responded with an error: `' . $response->getBody()->getContents() . '`';
        
        if ($message) {
            $errorMessage .= "\nMessage content: `" . $message . "`";
        }
        
        return new static($errorMessage);
    }

    /**
     * Thrown on a generic error.
     *
     * @param  mixed  $notification
     * @return static
     */
    public static function genericMessage($message)
    {
        return new static($message);
    }

    /**
     * Thrown if a notification instance does not implement a toExpo() method, but is
     * attempting to be delivered via the Expo notification channel.
     *
     * @param  mixed  $notification
     * @return static
     */
    public static function undefinedMethod($notification, $method = 'toExpo')
    {
        return new static(
            'Notification of class: ' . get_class($notification)
                . ' must define a `' . $method . '` method in order to send via Expo'
        );
    }

    /**
     * Thrown if a notification instance's `toExpo()` method,
     * does not return an instance of `\NotificationChannels\Expo\ExpoMessage`.
     *
     * @param  mixed  $notification
     * @return static
     */
    public static function couldNotCreateMessage($notification, $method = 'toExpo')
    {
        return new static(
            'Notification of class: ' . get_class($notification)
                . ' `' . $method . '` method did not return an instance of `\NotificationChannels\Expo\ExpoMessage`'
        );
    }

    /**
     * Thrown if a notifiable instance's `routeNotificationFor` method does not return a
     * valid Expo push token.
     *
     * @param  mixed  $notifiable
     * @return static
     */
    public static function noValidDestination($notifiable)
    {
        return new static(
            'Notifiable of class: ' . get_class($notifiable)
                . ' `routeNotificationFor()` method did not return a valid Expo Push Token'
        );
    }

    public static function noApiKey($notifiable)
    {
        return new static(
            'Notifiable of class: ' . get_class($notifiable)
                . 'did not find a valid API key, add DEEWAN_API_KEY in .env'
        );
    }

    /**
     * Thrown if a 400-level Http error was encountered whilst attempting to deliver the
     * notification.
     *
     * @return static
     */
    public static function clientError(ClientException $exception)
    {
        if (! $exception->hasResponse()) {
            return new static('Expo responded with an error but no response body was available');
        }

        $statusCode = $exception->getResponse()->getStatusCode();
        $description = $exception->getMessage();
        $responseBody = $exception->getResponse()->getBody()->getContents();

        return new static(
            "Failed to send notification, encountered client error: `{$statusCode} - {$description}`\nResponse: `{$responseBody}`"
        );
    }

    /**
     * Thrown if an unexpected exception was encountered whilst attempting to deliver the
     * notification.
     *
     * @return static
     */
    public static function unexpectedException(Exception $exception)
    {
        return new static(
            'Failed to send Expo notification, unexpected exception encountered: `' . $exception->getMessage() . '`',
            0,
            $exception
        );
    }
}

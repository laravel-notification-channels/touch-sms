<?php

namespace NotificationChannels\TouchSms;

use Illuminate\Notifications\Notification;
use NotificationChannels\TouchSms\Exceptions\CouldNotSendNotification;
use TouchSMS\TouchSMS\touchSMS;

class TouchSmsChannel
{
    /** @var touchSMS */
    private $client;

    public function __construct(touchSMS $client)
    {
        $this->client = $client;
    }

    public function send($notifiable, Notification $notification): void
    {
        $to = $notifiable->routeNotificationFor('touchsms');


        if (!$to) {
            $to = $notifiable->routeNotificationFor(TouchSmsChannel::class);
        }

        if (!$to) {
            return;
        }


        $message = $notification->toTouchsms($notifiable);

        if (is_string($message)) {
            $message = new TouchSmsMessage($message);
        }

        if (!$message instanceof TouchSmsMessage) {
            return;
        }

        $response = $this->client->sendMessage(
            $message->content,
            $to,
            $message->reference,
            $message->sender ?? config('services.touchsms.default_sender')
        );

        if ($response->code !== 200) {
            throw CouldNotSendNotification::touchSmsError($response->message ?? '', $response->code ?? 500);
        }
    }
}

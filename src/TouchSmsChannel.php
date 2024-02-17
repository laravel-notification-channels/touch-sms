<?php

namespace NotificationChannels\TouchSms;

use Illuminate\Notifications\Notification;
use NotificationChannels\TouchSms\Exceptions\CouldNotSendNotification;
use TouchSms\ApiClient\Api\Model\OutboundMessage;
use TouchSms\ApiClient\Api\Model\SendMessageBody;
use TouchSms\ApiClient\Client;

class TouchSmsChannel
{
    /** @var Client */
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function send($notifiable, Notification $notification): void
    {
        $to = $notifiable->routeNotificationFor('touchsms');

        if (! $to) {
            $to = $notifiable->routeNotificationFor(TouchSmsChannel::class);
        }

        if (! $to) {
            return;
        }

        $message = $notification->toTouchsms($notifiable);

        if (is_string($message)) {
            $message = new TouchSmsMessage($message);
        }

        if (! $message instanceof TouchSmsMessage) {
            return;
        }

        $apiMessage = (new OutboundMessage())
            ->setTo($to)
            ->setFrom($message->sender ?? config('services.touchsms.default_sender') ?? 'SHARED_NUMBER')
            ->setBody($message->content)
            ->setReference($message->reference)
            ->setMetadata($message->metadata);

        if ($message->sendAt) {
            $apiMessage->setDate($message->sendAt->format(\DateTimeInterface::ATOM));
        }

        $response = $this->client->sendMessages(
            (new SendMessageBody())->setMessages([$apiMessage])
        );

        if (! $response || count($response->getData()->getErrors())) {
            $error = $response->getData()->getErrors()[0];
            throw new CouldNotSendNotification($error->getErrorCode().($error->getErrorHelp() ? ' - '.$error->getErrorHelp() : ''), 400);
        }
    }
}

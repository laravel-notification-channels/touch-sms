<?php

namespace NotificationChannels\TouchSms\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function touchSmsError(string $message, int $code): self
    {
        return new static(sprintf('TouchSms responded with error %d, message: %s', $code, $message), $code);
    }
}

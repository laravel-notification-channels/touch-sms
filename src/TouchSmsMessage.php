<?php

namespace NotificationChannels\TouchSms;

use DateTimeInterface;

class TouchSmsMessage
{
    /** @var string */
    public $content;

    /** @var string|null */
    public $sender;

    /** @var string|null */
    public $campaign;

    /** @var string|null */
    public $reference;

    /** @var DateTimeInterface|null */
    public $sendAt;

    public function __construct(string $content = '')
    {
        $this->content = $content;
    }

    public function content(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function sender(string $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function sendAt(DateTimeInterface $sendAt): self
    {
        $this->sendAt = $sendAt;

        return $this;
    }

    public function campaign(string $campaign): self
    {
        $this->campaign = $campaign;

        return $this;
    }

    public function reference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }
}

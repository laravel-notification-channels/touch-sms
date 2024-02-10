<?php

namespace NotificationChannels\TouchSms;

use DateTimeInterface;

class TouchSmsMessage
{
    /** @var string */
    public string $content;

    /** @var string|null */
    public ?string $sender;

    /** @var string|null */
    public ?string $campaign;

    /** @var string|null */
    public ?string $reference;

    /** @var DateTimeInterface|null */
    public ?DateTimeInterface $sendAt;

    /** @var array|null */
    public ?array $metadata;

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

    public function metadata(array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function reference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }
}

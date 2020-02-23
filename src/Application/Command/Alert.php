<?php

namespace App\Application\Command;

class Alert
{
    const ALERT_INFO = 'info';
    const ALERT_ERROR = 'error';

    private string $message;
    private string $type;

    public function __construct(string $message, string $type = 'info')
    {
        $this->message = $message;
        $this->type = $type;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function __toString()
    {
        return sprintf('[%s] %s', $this->type, $this->message);
    }
}

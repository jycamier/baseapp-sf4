<?php

namespace App\Application\Command\Handler;

use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use App\Application\Command\Alert as AlertCommand;

class Alert implements MessageHandlerInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(AlertCommand $alert)
    {
        $this->logger->critical($alert->getMessage());
    }
}

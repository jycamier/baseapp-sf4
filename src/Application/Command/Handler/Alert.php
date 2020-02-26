<?php

namespace App\Application\Command\Handler;

use App\Infrastructure\Client\ConsumachineInterface;
use Psr\Log\LoggerInterface;
use Redis;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use App\Application\Command\Alert as AlertCommand;

class Alert implements MessageHandlerInterface
{
    private LoggerInterface $logger;
    private ConsumachineInterface $consumachine;

    public function __construct(LoggerInterface $logger, ConsumachineInterface $consumachine)
    {
        $this->logger = $logger;
        $this->consumachine = $consumachine;
    }

    public function __invoke(AlertCommand $alert)
    {
        $this->logger->critical($alert->getMessage());
        $this->consumachine->addOne();
    }
}

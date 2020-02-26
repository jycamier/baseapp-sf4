<?php

namespace App\Controller;

use App\Application\Command\Alert;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;

class Push
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function __invoke()
    {
        $this->messageBus->dispatch(new Alert('New consumption'));

        return new JsonResponse([
            'ok'
        ]);
    }
}

<?php

namespace App\Controller;

use App\Infrastructure\Client\ConsumachineInterface;
use Redis;
use Symfony\Component\HttpFoundation\JsonResponse;

class Consumptions
{
    public function __invoke(ConsumachineInterface $consumachine)
    {
        return new JsonResponse([
            'consumptions' => $consumachine->getValue()
         ]);
    }
}

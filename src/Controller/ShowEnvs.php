<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class ShowEnvs
{
    public function __invoke()
    {
        return new JsonResponse(getenv());
    }
}

<?php


namespace App\Infrastructure\Client;

use Redis;

class Consumachine implements ConsumachineInterface
{
    public const CONSUMPTION_KEY = 'consumptions';
    private Redis $client;

    public function __construct(string $redisHost, int $redisPort)
    {
        $this->client = new Redis();
        $this->client->connect($redisHost, $redisPort);

        if (!$this->client->ping()) {
            throw new \Exception("Redis doesn't respond");
        }
    }

    public function addOne(): void
    {
        $consumptions = $this->client->get(static::CONSUMPTION_KEY);
        if (false === $consumptions) {
            $consumptions = 0;
        }
        $this->client->set(static::CONSUMPTION_KEY, ++$consumptions);
    }

    public function getValue(): string
    {
        return $this->client->get(static::CONSUMPTION_KEY);
    }
}

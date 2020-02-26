<?php


namespace App\Infrastructure\Client;


interface ConsumachineInterface
{
    public function addOne(): void;

    public function getValue(): string;
}

<?php

namespace App\UI\Command;

use App\Infrastructure\Client\ConsumachineInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DoSomething extends Command
{
    protected static $defaultName = 'app:do-something';

    private ConsumachineInterface $consumachine;

    public function __construct(ConsumachineInterface $consumachine)
    {
        $this->consumachine = $consumachine;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Do something with the consumachine')
            ->setHelp('Yes...It is.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->consumachine->addOne();

        return 0;
    }
}

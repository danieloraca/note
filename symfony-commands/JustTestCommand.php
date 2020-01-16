<?php
declare(strict_types=1);

namespace Gant\Bundle\CbrBundle\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class JustTestCommand extends Command
{
    protected static $defaultName = 'dan:just_test';

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('just a test command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>xWorking Just Test! Done!</info>');
    }
}

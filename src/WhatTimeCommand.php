<?php

namespace App;

use Carbon\Carbon;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WhatTimeCommand extends Command
{
    protected static $defaultName = 'what_time';

    protected function configure()
    {
        $this->setDescription('show current time');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $time = Carbon::now();

        $output->writeln($time->toRfc822String());

        return 0;
    }
}

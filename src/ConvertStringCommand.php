<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ConvertStringCommand extends Command
{
    public static $defaultName = 'convert:string';

    protected function configure()
    {
        $this
            ->setDescription('Converter string AbAaB')
            ->addArgument(
                'string',
                InputArgument::IS_ARRAY | InputArgument::REQUIRED,
                'Converted string',
            )
            ->addOption(
                'options',
                'o',
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Even or odd characters?',
                ['even', 'odd'],
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $arrayStr = $input->getArgument('string');
        $str = '';

        $options = $input->getOption('options');

        if (count($arrayStr) > 0) {
            $str .= implode(' ', $arrayStr);
        }

        $str = $this->convertString($str, $options[0] === 'even' || $options[0] === '=even');

        $output->writeln($str);

        return 0;
    }

    /**
     * @param string $string
     * @param bool $convert 0 = ODD || 1 = EVEN
     * @return string
     */
    private function convertString(string $string = '', bool $convert = true): string
    {
        $arr = mb_str_split($string);
        $str = '';

        foreach ($arr as $key => $value) {
            $str .= $key % 2 == $convert ? mb_strtolower($value) : mb_strtoupper($value);
        }

        return $str;
    }
}

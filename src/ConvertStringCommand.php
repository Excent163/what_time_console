<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
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
                'Converted string'
            )
            ->addOption('odd', 'o', null, 'Odd characters')
            ->addOption('even', 'e', null, 'Even characters')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $arrayStr = $input->getArgument('string');
        $str = '';

        if (count($arrayStr) > 0) {
            $str .= implode(' ', $arrayStr);
        }

        if ($input->getOption('odd')) {
            $str = $this->convertString($str, 'odd');
        } elseif ($input->getOption('even')) {
            $str = $this->convertString($str, 'even');
        } else {
            $str = $this->convertString($str);
        }

        $output->writeln($str);

        return 0;
    }

    /**
     * @param string $string
     * @param string $convert ODD || EVEN
     * @return string
     */
    private function convertString(string $string = '', string $convert = 'odd'): string
    {
        $arr = mb_str_split($string);
        $str = '';

        $convert = $convert === 'even' ? 1 : 0;

        foreach ($arr as $key => $value) {
            if ($key % 2 == $convert) {
                $str .= mb_strtolower($value);
            } else {
                $str .= mb_strtoupper($value);
            }
        }

        return $str;
    }
}

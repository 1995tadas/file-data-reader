<?php

namespace App\Services;

use App\Factories\ParseFileFactory;

class Cli
{
    private array $arguments;

    /**
     * Validates and sets passed arguments
     *
     * @param array $arguments
     */
    public function setArguments(array $arguments)
    {
        if (count($arguments) < 2) {
            throw new \InvalidArgumentException('You should pass at least one argument!');
        }

        array_shift($arguments);

        $this->arguments = $arguments;
    }

    /**
     * Prints ParseFileFactory content to terminal
     *
     * @return void
     * @throws \Exception
     */
    public function output(): void
    {
        print_r(ParseFileFactory::parse($this->arguments[0]));
    }
}
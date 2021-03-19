<?php

namespace App\Services;

use App\Factories\ParseFile\ParseFileFactory;
use Exception;
use InvalidArgumentException;

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
            throw new InvalidArgumentException('You should pass at least one argument!');
        }

        array_shift($arguments);

        $this->arguments = $arguments;
    }

    /**
     * Prints ParseFileFactory content to terminal
     *
     * @return void
     * @throws Exception
     */
    public function output(): void
    {
        $parseFileFactory = new ParseFileFactory($this->arguments[0]);
        print_r($parseFileFactory->parse());
    }
}
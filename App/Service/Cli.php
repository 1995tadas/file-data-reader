<?php

namespace App\Service;

use App\Factory\ParseFileFactory;

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
     * @return array
     * @throws \Exception
     */
    public function output(): array
    {
        return ParseFileFactory::create($this->arguments[0]);
    }
}
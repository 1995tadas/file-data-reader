<?php

namespace App\factory;

use App\Service\ParseFile;

class ParseFileFactory
{
    /**
     * Factory for ParseFile class
     *
     * @param $path
     * @return array
     * @throws \Exception
     */
    public static function create($path): array
    {
        $parseFile = new ParseFile($path);
        return $parseFile->parse();
    }
}
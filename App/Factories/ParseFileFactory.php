<?php

namespace App\Factories;

use App\Services\ParseFile;

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
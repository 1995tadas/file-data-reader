<?php

namespace App\Factories\ParseFile\ParseFileFormats;

use Exception;

class Json
{
    /**
     * Json file parsing
     *
     * Firstly file content will be red
     * then json will be decoded into associative array
     * if there is errors present - exception will be thrown
     *
     * @param string $path
     * @return array
     * @throws Exception
     */
    public function __invoke(string $path): array
    {
        $fileContent = file_get_contents($path);
        $json = json_decode($fileContent, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception(sprintf('The Json "%s" file not valid', $path));
        }

        return $json;
    }
}
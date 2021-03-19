<?php

namespace App\Factories\ParseFile\ParseFileFormats;

class Csv
{

    /**
     * Csv file parsing
     *
     * First line will read csv file and turn every row to arrays in array;
     * Header will be separated into variable and removed from array;
     * Then header array will be combined with csv array content and set as keys
     * if array row have the same amount of elements as header
     *
     * @param string $path
     * @return array
     */
    public function __invoke(string $path): array
    {
        $fileContent = array_map('str_getcsv', file($path));

        $fileHeader = $fileContent[0];
        array_shift($fileContent);

        array_walk($fileContent, function (&$fileLine) use ($fileHeader) {
            if (count($fileHeader) === count($fileLine)) {
                $fileLine = array_combine($fileHeader, $fileLine);
            }
        });

        return $fileContent;
    }
}
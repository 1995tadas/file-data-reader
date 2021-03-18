<?php

namespace App\Services;

class ParseFile
{
    /**
     * @var string
     */
    private string $path;

    /**
     * @var mixed|string
     */
    private $extension;

    /**
     * ParseFile constructor and validator.
     *
     * @param $path
     * @throws \Exception
     */
    public function __construct($path)
    {
        if (!file_exists($path) || !filesize($path)) {
            throw new \Exception(sprintf('The file "%s" does not exist or is empty', $path));
        }

        $pathInfo = pathinfo($path);

        if (!isset($pathInfo['extension'])) {
            throw new \Exception(sprintf('The file "%s" does not have extension', $path));
        }

        if (!in_array($pathInfo['extension'], env('SUPPORTED_FILES'))) {
            throw new \Exception(sprintf('The file extension "%s" does not supported', $pathInfo['extension']));
        }

        $this->extension = $pathInfo['extension'];

        $this->path = $path;

    }

    /**
     * Parses file depending on his extension
     *
     * @return array
     */
    public function parse(): array
    {
        return $this->{$this->extension}($this->path);
    }

    /**
     * Json file parsing
     *
     * Firstly file content will be red
     * then json will be decoded into associative array
     * if there is errors present - exception will be thrown
     *
     * @param string $path
     * @return array
     * @throws \Exception
     */
    private function json(string $path): array
    {
        $fileContent = file_get_contents($path);
        $json = json_decode($fileContent, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception(sprintf('The Json "%s" file not valid', $path));
        }

        return $json;
    }

    /**
     * xml file parsing
     *
     * Firstly file content will be red
     * then xml will be decoded into object;
     * For purpose of creating associative array xmlObject
     * will be casted to array then json encoded back and forth
     *
     * @param string $path
     * @return array
     */
    private function xml(string $path): array
    {
        $fileContent = file_get_contents($path);
        $xmlObject = simplexml_load_string($fileContent);
        return json_decode(json_encode((array)$xmlObject), true);
    }

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
    private function csv(string $path): array
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
<?php

namespace App\Service;

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
     * json file parsing
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
     * @param string $path
     * @return array
     */
    private function xml(string $path): array
    {
        $fileContent = file_get_contents($path);
        return json_decode(json_encode((array)simplexml_load_string($fileContent)), true);
    }

    /**
     * csv file parsing
     *
     * @param string $path
     * @return array
     */
    private function csv(string $path): array
    {
        $fileContent = array_map('str_getcsv', file($path));
        $fileHeader = $fileContent[0];

        array_walk($fileContent, function (&$fileLine) use ($fileHeader) {
            if (count($fileHeader) === count($fileLine)) {
                $fileLine = array_combine($fileHeader, $fileLine);
            }
        });
        array_shift($fileContent);

        return $fileContent;
    }
}
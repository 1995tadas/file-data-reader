<?php

namespace App\Factories\ParseFile;

use Exception;

class ParseFileFactory
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
     * @throws Exception
     */
    public function __construct($path)
    {
        if (!file_exists($path) || !filesize($path)) {
            throw new Exception(sprintf('The file "%s" does not exist or is empty', $path));
        }

        $pathInfo = pathinfo($path);

        if (!isset($pathInfo['extension'])) {
            throw new Exception(sprintf('The file "%s" does not have extension', $path));
        }

        if (!in_array($pathInfo['extension'], env('SUPPORTED_FILES'))) {
            throw new Exception(sprintf('The file extension "%s" does not supported', $pathInfo['extension']));
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
        $output = new ("App\Factories\ParseFile\ParseFileFormats\\".$this->extension)();
        return $output($this->path);
    }
}
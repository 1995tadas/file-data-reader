<?php

namespace App\Factories\ParseFile\ParseFileFormats;

class Xml
{

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
    public function __invoke(string $path): array
    {
        $fileContent = file_get_contents($path);
        $xmlObject = simplexml_load_string($fileContent);
        return json_decode(json_encode((array)$xmlObject), true);
    }
}
<?php

$variables = [
    'SUPPORTED_FILES' => ['csv', 'json', 'xml'],
    'APP_DEBUG' => false
];

foreach ($variables as $key => $value) {
    if(is_array($value)){
        $value = implode(',', $value);
    }

    putenv("$key=$value");
}

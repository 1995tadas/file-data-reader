<?php

$variables = [
    'SUPPORTED_FILES' => ['csv', 'json', 'xml'],
    'APP_DEBUG' => false
];


/*
 * Sets variable to environmental variable
 * which only exists for the duration of the current request;
 *
 * Array variables will be imploded into string with "," separator.
 * DO NOT use "," in env variables
 */
foreach ($variables as $key => $value) {
    if (is_array($value)) {
        $value = implode(',', $value);
    }

    putenv("$key=$value");
}

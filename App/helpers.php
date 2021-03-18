<?php

/*
    Helper for reading env variable form env.php file
*/
if (!function_exists('env')) {
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return $default;
        }

        if(strpos($value, ',') !== false) {
            $value = explode(',', $value);
        }

        return $value;
    }
}
<?php
require __DIR__ . '/autoload.php';

if(env('APP_DEBUG')){
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

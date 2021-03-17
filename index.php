<?php
require __DIR__ . '/App/autoload.php';

use App\Service\Cli;

if(env('APP_DEBUG')){
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

$cli = new Cli();
$cli->setArguments($argv);
print_r($cli->output());
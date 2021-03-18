<?php
require __DIR__ . '/App/autoload.php';

use App\Services\Cli;

if (env('APP_DEBUG')) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

$cli = new Cli();
$cli->setArguments($argv);
$cli->output();
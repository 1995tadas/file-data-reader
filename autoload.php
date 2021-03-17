<?php

$files = ['env.php', 'helpers.php'];
foreach ($files as $file){
    require_once $file;
}

spl_autoload_register(function ($className) {
    require_once $className . '.php';
});
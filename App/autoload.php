<?php

$files = ['env.php', 'app\helpers.php'];
foreach ($files as $file) {
    require_once $file;
}

spl_autoload_register(function ($className) {
    require_once str_replace("\\", "/", $className) . '.php';
});
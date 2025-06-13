<?php

spl_autoload_register(function ($class) {
    $paths = [
        ROOT_URL . '/core/' . $class . '.php',
        ROOT_URL . '/app/controllers/' . $class . '.php',
        ROOT_URL . '/app/models/' . $class . '.php',
    ];

    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            break;
        }
    }
});
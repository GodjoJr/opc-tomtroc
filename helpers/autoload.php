<?php
spl_autoload_register(function ($class) {
    // Transform namespace separators into directory separators
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    // We assume that the root namespace corresponds to the root directory
    $file = ROOT_URL . '/' . $classPath . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

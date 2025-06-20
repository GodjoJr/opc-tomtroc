<?php

spl_autoload_register(function ($class) {
    // On transforme les \ en / pour correspondre aux dossiers
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    // On suppose que le namespace racine correspond à l’arborescence des dossiers
    $file = ROOT_URL . '/' . $classPath . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

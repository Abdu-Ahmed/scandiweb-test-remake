<?php

spl_autoload_register(function ($class) {
    // Project root directory
    $root = dirname(__DIR__);

    // Replace namespace separator with directory separator
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    // File path
    $file = "{$root}/{$class}.php";

    // If file exists, require it
    if (file_exists($file)) {
        require_once $file;
    }
});
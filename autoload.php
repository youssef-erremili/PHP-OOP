<?php
spl_autoload_register(function ($class) {
    $directories = [
        __DIR__ . '/Controller/',
        __DIR__ . '/Database/',
        __DIR__ . '/Models/',
        __DIR__ . '/Interfaces/',
        __DIR__ . '/Traits/'
    ];

    foreach ($directories as $dir) {
        $file = $dir . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

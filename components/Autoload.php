<?php

spl_autoload_register(function ($class_name)
{
    // Список директорий искомых классов
    $array_paths = array(
        '/models/',
        '/components/',
        '/config/'
    );

    foreach ($array_paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
});
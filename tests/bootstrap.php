<?php

spl_autoload_register(function(string $class) {
    $file = sprintf(
        'src/%s.php',
        str_replace(['jjok\Switches\\', '\\'], ['', '/'], $class)
    );

    if(file_exists($file)) {
        require_once $file;
    }
});

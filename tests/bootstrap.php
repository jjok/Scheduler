<?php

spl_autoload_register(function(string $class) {
    require_once sprintf('src/%s.php', str_replace('\\', '/', $class));
});

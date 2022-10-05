<?php

declare(strict_types=1);

spl_autoload_register(static function ($class) {
    include_once $class . '.php';
});

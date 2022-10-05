<?php

declare(strict_types=1);

require 'autoload.php';

use Modules\CaesarCipher;
use Modules\Console;
use Modules\FileManager;

$caesarCipher = new CaesarCipher();
$fileManager = new FileManager();
$console = new Console($caesarCipher, $fileManager);

$console->generatePassword();

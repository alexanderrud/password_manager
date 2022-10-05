<?php

declare(strict_types=1);

$modules = array_diff(scandir('modules'), ['..', '.']);

foreach ($modules as $module) {
    include 'modules/' . $module;
}

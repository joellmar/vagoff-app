<?php

declare(strict_types=1);

use VagOff\App\Service\TaskManager;

require __DIR__ . "/../vendor/autoload.php";

session_start();

$taskManager = new TaskManager();


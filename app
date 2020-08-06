#!/usr/bin/env php
<?php

declare(strict_types=1);

use App\ConvertStringCommand;
use App\WhatTimeCommand;
use Symfony\Component\Console\Application;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$app = new Application('Demo application');
$app->add(new WhatTimeCommand());
$app->add(new ConvertStringCommand());
$app->run();

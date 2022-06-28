<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/cloud_storage.php';

use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new Thumbnails\ConsoleCommands\SaveThumbnailOnHardDisk('app:hard_disk:convert_to_thumbnail'));
$application->add(new Thumbnails\ConsoleCommands\SaveThumbnailOnCloud('app:aws:convert_to_thumbnail'));

$application->run();
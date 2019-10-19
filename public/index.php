<?php

define('APP', __DIR__ . '/../app/');
define('ROOTDIR', __DIR__ . '/../');

$loader = require '../vendor/autoload.php';

$loader->addPsr4('Matrix\\', '../vendor/matrix');
$loader->addPsr4('App\\', APP);

use Matrix\Route;

Route::init();
Route::run();
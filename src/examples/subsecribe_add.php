<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use cccdl\yunxin_sdk\Im\User;

$im = new User($appId, $key);

$add = $im->getUserInfos([4]);

var_dump($add);
die;
<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use cccdl\yunxin_sdk\Im\Subscribe;

$im = new Subscribe($appId, $key);

$add = $im->batchDel('28');

var_dump($add);
die;
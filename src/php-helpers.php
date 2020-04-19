<?php

use link\hefang\helpers\ClassHelper;

version_compare(PHP_VERSION, "7.0.0", ">=") or die("PHP版本7.0.0以上才能使用该库, 当前PHP版本为:" . PHP_VERSION . PHP_EOL);
define("PHP_HELPERS", true);
define("PHP_HELPERS_VERSION", "1.1.1");

ini_set("date.timezone", "Asia/Shanghai");

require __DIR__ . "/link/hefang/helpers/ClassHelper.class.php";

ClassHelper::loader(__DIR__);
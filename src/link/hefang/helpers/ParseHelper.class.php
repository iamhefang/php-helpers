<?php

namespace link\hefang\helpers;
defined("PHP_HELPERS") or die(1);

final class ParseHelper
{
    const FALSE_VALUES = [
        "0", "false", "no", "null", "undefined", "not", "否", "关", "不", "错", "假", "非", "甭", "闭", "off"
    ];
    const TRUE_VALUES = [
        "1", "true", "yes", "是", "真", "对", "开", "启", "on"
    ];

    public static function parseBoolean($obj, bool $defaultValue = false): bool
    {
        if (StringHelper::isNullOrBlank($obj)) {
            return $defaultValue;
        } else {
            return !in_array($obj . "", $defaultValue ? self::TRUE_VALUES : self::FALSE_VALUES);
        }
    }

    private function __construct()
    {
    }
}
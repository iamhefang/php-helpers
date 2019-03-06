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

    /**
     * 将其他类型转化为bool型
     * @param mixed|null $obj 要转换的内容
     * 若是非空字符串则在{#TRUE_VALUES}中的为true, 在{#FALSE_VALUES}中的为false,
     * 若是其他值则由php处理
     * @param bool $defaultValue 默认值
     * 若默认值为true, 则除{#FALSE_VALUES}外的任何字符串都认为是true
     * 若默认值为false, 则除{#TRUE_VALUES}外的任何字符串都认为是false
     * @return bool
     */
    public static function parseBoolean($obj, bool $defaultValue = false): bool
    {
        if (is_string($obj) && !StringHelper::isNullOrEmpty($obj)) {
            if ($defaultValue) {
                return !in_array(strtolower($obj), self::FALSE_VALUES);
            } else {
                return in_array(strtolower($obj), self::TRUE_VALUES);
            }
        }
        return !!$obj;
    }

    private function __construct()
    {
    }
}
<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/3
 * Time: 14:33
 */

namespace link\hefang\helpers;
defined("PHP_HELPERS") or die(1);

class StringHelper
{

    /**
     * @param string $string
     * @param bool $ignoreCase
     * @param string $searches [optional]
     * @return bool
     */
    public static function endsWith(string $string, bool $ignoreCase = false, string $searches)
    {
        $args = func_get_args();
        $string = array_shift($args);
        $ignoreCase = array_shift($args);
        ObjectHelper::checkNull($string);
        $strLen = strlen($string);
        if ($strLen === 0) return false;
        foreach ($args as $arg) {
            if ($arg === null) continue;
            $len = strlen($arg);
            if ($len > $strLen) continue;
            return substr_compare($string, $arg, $strLen - $len, $len, $ignoreCase) === 0;
        }
        return false;
    }

    /**
     * @param string $string
     * @param bool $ignoreCase
     * @param string $searches [optional]
     * @return bool
     */
    public static function startsWith(string $string, bool $ignoreCase = false, string $searches)
    {
        $args = func_get_args();
        $string = array_shift($args);
        $ignoreCase = array_shift($args);
        ObjectHelper::checkNull($string);
        $strLen = strlen($string);
        if ($strLen === 0) return false;
        foreach ($args as $arg) {
            if ($arg === null) continue;
            $len = strlen($arg);
            if ($len > $strLen) continue;
            if ($ignoreCase ? strncasecmp($string, $arg, $len) : strncmp($string, $arg, $len)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $string string|null
     * @return bool
     */
    public static function isNullOrBlank($string): bool
    {
        if ($string === null) return true;
        return self::isNullOrEmpty(trim($string));
    }

    /**
     * @param $string string|null
     * @return bool
     */
    public static function isNullOrEmpty($string): bool
    {
        if ($string === null) return true;
        return strlen($string) === 0;
    }


    /**
     * StringHelper constructor.
     */
    private function __construct()
    {
    }

}
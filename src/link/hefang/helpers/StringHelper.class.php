<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/3
 * Time: 14:33
 */

namespace link\hefang\helpers;

defined("PHP_HELPERS") or die(1);

final class StringHelper
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
     * 截断字符串
     * @param string $str 要截断的字符串
     * @param int $maxLength 最大长度
     * @param bool $appendDot 是否在字符串结尾加...
     * @return string
     */
    public static function shortStr(string $str, int $maxLength, bool $appendDot = false): string
    {
        return (strlen($str) > $maxLength ? (substr($str, 0, $appendDot ? $maxLength - 3 : $maxLength)) : $str) . ($appendDot ? "..." : "");
    }

    public static function queryString(
        array $map,
        bool $urlEncode = true,
        bool $ignoreNull = false,
        bool $ignoreEmpty = false): string
    {
        $res = "";
        if (!empty($map)) {
            foreach ($map as $key => $value) {
                if ($ignoreNull && $value === null) continue;
                if ($ignoreEmpty && StringHelper::isNullOrEmpty($value)) continue;
                $res .= "$key=" . ($urlEncode ? urlencode($value) : $value);
            }
        };
        return $res;
    }

    /**
     * 连接字符串
     * @param string $items [optional] 要连接的字符串
     * @return string
     */
    public static function contact($items)
    {
        return join("", func_get_args());
    }


    /**
     * StringHelper constructor.
     */
    private function __construct()
    {
    }
}
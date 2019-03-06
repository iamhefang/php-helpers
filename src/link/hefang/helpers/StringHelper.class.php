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
     * 将驼峰写法的字符串转换为下划线
     * @param string $string
     * @return string
     */
    public static function hump2underLine(string $string): string
    {
        $charArr = preg_split("//u", $string, -1, PREG_SPLIT_NO_EMPTY);
        $str = '';
        for ($idx = 0; $idx < count($charArr); $idx++) {
            $ascii = ord($charArr[$idx]);
            if ($ascii >= 65 && $ascii <= 90) {
                $str .= ($idx === 0 ? '' : '_') . strtolower($charArr[$idx]);
            } else {
                $str .= $charArr[$idx];
            }
        }
        return $str;
    }

    /**
     * 将下划线连接的字符串转换为驼峰
     * @param string $string
     * @param bool $upperFirstChar 第一个字母是否大写
     * @return string
     */
    public static function underLine2hump(string $string, bool $upperFirstChar = true): string
    {
        $chars = explode("_", trim($string, "_"));
        if ($upperFirstChar) {
            return join('', array_map('ucfirst', $chars));
        }
        return array_shift($chars) . join('', array_map('ucfirst', $chars));
    }

    /**
     * @param string $string
     * @param bool $ignoreCase
     * @param string|array $searches [optional]
     * @return bool
     */
    public static function contains(string $string, bool $ignoreCase = false, $searches = ''): bool
    {
        if (!is_array($searches)) {
            $searches = func_get_args();
            $string = array_shift($searches);
            $ignoreCase = array_shift($searches);
        }
        if (!strlen($string)) return false;

        $ignoreCase and $string = strtolower($string);

        foreach ($searches as $search) {
            if (!$search) continue;
            $ignoreCase and $search = strtolower($search);
            if (strpos($string, $search) !== false) return true;
        }
        return false;
    }

    /**
     * @param string $string
     * @param bool $ignoreCase
     * @param string|array $searches [optional]
     * @return bool
     */
    public static function endsWith(string $string, bool $ignoreCase = false, $searches = '')
    {
        if (!is_array($searches)) {
            $searches = func_get_args();
            $string = array_shift($searches);
            $ignoreCase = array_shift($searches);
        }

        $strLen = strlen($string);
        if ($strLen === 0) return false;
        foreach ($searches as $search) {
            if (!$search) continue;
            $len = strlen($search);
            if ($len > $strLen) continue;
            return substr_compare($string, $search, $strLen - $len, $len, $ignoreCase) === 0;
        }
        return false;
    }

    /**
     * @param string $string
     * @param bool $ignoreCase
     * @param string $searches [optional]
     * @return bool
     */
    public static function startsWith(string $string, bool $ignoreCase = false, $searches = '')
    {
        if (!is_array($searches)) {
            $searches = func_get_args();
            $string = array_shift($searches);
            $ignoreCase = array_shift($searches);
        }
        $strLen = strlen($string);
        if ($strLen === 0) return false;
        foreach ($searches as $search) {
            if (!$search) continue;
            $len = strlen($search);
            if ($len > $strLen) continue;
            $match = $ignoreCase ? strncasecmp($string, $search, $len) : strncmp($string, $search, $len);
            if ($match === 0) {
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
        return (mb_strlen($str) > $maxLength ? (mb_substr($str, 0, $appendDot ? $maxLength - 3 : $maxLength)) : $str) . ($appendDot ? "..." : "");
    }

    public static function queryString(
        array $map,
        bool $urlEncode = true,
        bool $ignoreNull = false,
        bool $ignoreEmpty = false): string
    {
        $res = [];
        if (!empty($map)) {
            foreach ($map as $key => $value) {
                if ($ignoreNull && $value === null) continue;
                if ($ignoreEmpty && StringHelper::isNullOrEmpty($value)) continue;
                $res[] = "$key=" . ($urlEncode ? urlencode($value) : $value);
            }
        };
        return join('&', $res);
    }

    /**
     * 连接字符串
     * @param string $items [optional] 要连接的字符串
     * @return string
     */
    public static function contact($items)
    {
        return join("", is_array($items) ? $items : func_get_args());
    }


    /**
     * StringHelper constructor.
     */
    private function __construct()
    {
    }
}
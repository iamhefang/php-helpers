<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/3
 * Time: 17:43
 */

namespace link\hefang\helpers;
defined("PHP_HELPERS") or die(1);

final class RandomHelper
{
    /**
     * 小写字母集
     */
    const LOWERS = "abcdefghigklmnopqrstuvwxyz";

    /**
     * 大写字母集
     */
    const UPPERS = "ABCDEFGHIGKLMNOPQRSTUVWXYZ";

    /**
     * 数字集
     */
    const DIGITS = "1234567890";

    /**
     * 符号集
     */
    const SYMBOL = "`~!@#$%^&*()_+-=[]\\{}|,./<>?;:'\"";

    public static function LETTERS(string $types): string
    {
        $type = str_split(strtoupper($types));
        $res = "";
        foreach ($type as $item) {
            if ($item === "L") {
                $res .= self::LOWERS;
            } else if ($item === "U") {
                $res .= self::UPPERS;
            } else if ($item === "D") {
                $res .= self::DIGITS;
            } else if ($item === "S") {
                $res .= self::SYMBOL;
            }
        }
        return $res;
    }

    /**
     * 生成40位全局唯一id, 数据表主键一般使用这个值
     * @return string
     */
    public static function guid()
    {
        return self::string(40, self::LETTERS("LDU"));
    }

    /**
     * 生成随机字符串
     * @param int $length 长度
     * @param string|null $src 原始字符串
     * @return string
     */
    public static function string(int $length, string $src = null)
    {
        if ($length < 1) return "";
        $src = StringHelper::isNullOrBlank($src) ? self::LETTERS("LDUS") : $src;
        $max = strlen($src) - 1;
        $res = "";
        for ($i = 0; $i < $length; $i++) {
            $res .= $src{rand(0, $max)};
        }
        return $res;
    }

    /**
     * 生成随机字符串
     * @param int $length 长度
     * @param bool $containsDigit 是否包含数字
     * @return string
     */
    public static function letter(int $length, bool $containsDigit = true)
    {
        return self::string($length, self::LETTERS($containsDigit ? "LDU" : "LU"));
    }

    /**
     * 生成随机数字字符串
     * @param int $length 长度
     * @return string
     */
    public static function digit(int $length)
    {
        return self::string($length, self::DIGITS);
    }

    /**
     * 生成随机大写字符串
     * @param int $length 长度
     * @return string
     */
    public static function upper(int $length)
    {
        return self::string($length, self::UPPERS);
    }

    /**
     * 生成随机小写字符串
     * @param int $length 长度
     * @return string
     */
    public static function lower(int $length)
    {
        return self::string($length, self::LOWERS);
    }
}
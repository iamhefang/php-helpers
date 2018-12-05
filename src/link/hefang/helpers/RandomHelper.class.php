<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/3
 * Time: 17:43
 */

namespace link\hefang\helpers;
defined("PHP_HELPERS") or die(1);

class RandomHelper
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

    public static function guid()
    {
        return self::string(40, self::LETTERS("LDU"));
    }

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
}
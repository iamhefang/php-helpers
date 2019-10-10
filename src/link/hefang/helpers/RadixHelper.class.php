<?php


namespace link\hefang\helpers;


use link\hefang\exceptions\ParamsException;

final class RadixHelper
{
    const MAP = [
        0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
        'a', 'b', 'c', 'd', 'e', 'f', 'g',
        'h', 'i', 'j', 'k', 'l', 'm', 'n',
        'o', 'p', 'q', 'r', 's', 't',
        'u', 'v', 'w', 'x', 'y', 'z'
    ];

    public static function dec2radix($number, int $radix)
    {
        $length = count(self::MAP);
        if ($radix < 2 || $radix > $length) {
            throw new ParamsException("radix只能在2到{$length}之间");
        }
        $result = [];
        for (; $number > 0; $result[] = self::MAP[$number % $radix], $number = intval($number / $radix)) ;
        return join("", array_reverse($result));
    }
}

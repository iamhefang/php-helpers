<?php


namespace link\hefang\helpers;


use PHPUnit\Framework\TestCase;

class TestRadixHelper extends TestCase
{
    public function testTen2Radix()
    {
        $dataRadix16 = [
            1 => '1',
            10 => 'a',
            11 => 'b',
            15 => 'f',
            16 => '10'
        ];
        foreach ($dataRadix16 as $ten => $radix) {
            echo "test for $ten => $radix\n";
            self::assertEquals(RadixHelper::dec2radix($ten, 16), $radix);
        }

        try {
            RadixHelper::dec2radix(10101010, 100);
            self::fail("进制小于2和大于36将抛出异常, 并没有抛出");
        } catch (\Exception $e) {
            echo "异常正常抛出\n";
        }

        self::assertEquals(RadixHelper::dec2radix(3763564953417213000, 36), "sldkfj2948go");
    }
}

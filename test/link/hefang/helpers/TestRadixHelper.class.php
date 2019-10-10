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
            self::assertEquals(RadixHelper::ten2Radix($ten, 16), $radix);
        }
        self::assertEquals(RadixHelper::ten2Radix(3763564953417213000, 36), "sldkfj2948fs");
    }
}
<?php

namespace link\hefang\helpers;


use PHPUnit\Framework\TestCase;

class TestParseHelper extends TestCase
{
    public function testParseBoolean()
    {
        foreach (ParseHelper::FALSE_VALUES as $value) {
            self::assertFalse(ParseHelper::parseBoolean($value));
        }
        foreach (ParseHelper::TRUE_VALUES as $value) {
            self::assertTrue(ParseHelper::parseBoolean($value));
        }
        foreach (['FALSE', 'FalsE', '0', 0, false, '', null] as $value) {
            self::assertFalse(ParseHelper::parseBoolean($value));
        }
        foreach (['TrUe', 1, '1', 100, 'sdfsdfsdfsd', [1, 2]] as $value) {
            $bool = ParseHelper::parseBoolean($value, true);
            print (json_encode($value) . ":" . ($bool ? "true" : "false") . "\n");
            self::assertTrue($bool);
        }
    }
}
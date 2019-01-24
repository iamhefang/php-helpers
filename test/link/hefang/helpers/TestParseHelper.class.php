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
    }
}
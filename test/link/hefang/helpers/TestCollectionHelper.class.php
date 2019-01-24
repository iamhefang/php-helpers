<?php

namespace link\hefang\helpers;

use PHPUnit\Framework\TestCase;

defined('PROJECT_NAME') or die("Access Refused");


class TestCollectionHelper extends TestCase
{
    private static $arr = ['b' => 1, 'a' => null, 'c' => ''];

    public function testGetOrDefault()
    {
        self::assertNull(CollectionHelper::getOrDefault(self::$arr, 'd'));
        self::assertEquals(CollectionHelper::getOrDefault(self::$arr, 'a'), null);
        self::assertEquals(CollectionHelper::getOrDefault(self::$arr, 'd', 11), 11);
    }

    public function testFirst()
    {
        self::assertEquals(CollectionHelper::first(self::$arr), 1);
        self::assertEquals(CollectionHelper::first(array_keys(self::$arr)), 'b');
        self::assertEquals(CollectionHelper::first(array_values(self::$arr)), 1);
    }

    public function testLast()
    {
        self::assertEquals(CollectionHelper::last(self::$arr), 1);
        self::assertEquals(CollectionHelper::last(array_keys(self::$arr)), 'c');
        self::assertEquals(CollectionHelper::last(array_values(self::$arr)), '');
    }

}
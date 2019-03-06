<?php

namespace link\hefang\helpers;
require_once "../../../../src/php-helpers.php";

use PHPUnit\Framework\TestCase;

class TestObjectHelper extends TestCase
{
    public function testNullOrDefault()
    {
        $var = null;
        $msg = "1111111";
        self::assertEquals(ObjectHelper::nullOrDefault($var, $msg), $msg);
    }

    public function testGetPro()
    {
        try {
            $res = ObjectHelper::getProperty(self::class, __METHOD__);
            self::assertNotNull($res);
            self::assertEquals($res->getName(), __METHOD__);
        } catch (\Throwable $e) {
            self::assertTrue($e instanceof \ReflectionException);
        }
    }

    public function testFindPro()
    {
        try {
            $res = ObjectHelper::fetchProperty(new \ReflectionClass(self::class), 'getGroups');
            self::assertNotNull($res);
            self::assertEquals($res->getName(), 'getGroups');
        } catch (\Throwable $e) {
            self::assertTrue($e instanceof \ReflectionException);
        }
    }
}
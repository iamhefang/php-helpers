<?php

namespace link\hefang\helpers;


use PHPUnit\Framework\TestCase;

class TestTimeHelper extends TestCase
{
    public function testIsLeapYear()
    {
        $data = [
            1993 => false,
            2008 => true,
            2018 => false,
            2019 => false,
            2000 => false,
            2100 => true
        ];
        foreach ($data as $year => $isLeap) {
            self::assertEquals(TimeHelper::isLeapYear($year), $isLeap);
        }
    }

    public function testDaysOf()
    {
        self::assertEquals(TimeHelper::daysOf(2019), 365);
        self::assertEquals(TimeHelper::daysOf(2019, 1), 31);
        self::assertEquals(TimeHelper::daysOf(2019, 2), 28);
        self::assertEquals(TimeHelper::daysOf(2019, 4), 30);
        self::assertEquals(TimeHelper::daysOf(2008, 1), 31);
        self::assertEquals(TimeHelper::daysOf(2008, 2), 29);
        self::assertEquals(TimeHelper::daysOf(2008, 4), 30);
    }
}
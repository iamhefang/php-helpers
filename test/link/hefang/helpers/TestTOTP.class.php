<?php
namespace link\hefang\helpers;

use link\hefang\otp\TOTP;
use PHPUnit\Framework\TestCase;

class TestTOTP extends TestCase
{
    public function testTOTP()
    {
        $times = [
            1551836737 => '005969',
            1551836758 => '005969',
            1551836775 => '217874',
            1551836884 => '623965'
        ];
        $totp = new TOTP("JBSWY3DPEHPK3PXP");
        foreach ($times as $time => $token) {
            self::assertEquals($totp->at($time), $token);
        }
    }
}
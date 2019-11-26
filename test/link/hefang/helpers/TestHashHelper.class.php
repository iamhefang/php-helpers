<?php


namespace link\hefang\helpers;


use PHPUnit\Framework\TestCase;

class TestHashHelper extends TestCase
{
   function testPasswordHash()
   {
      for ($i = 0; $i < 100; $i++) { $password = RandomHelper::string(rand(1, 100));
         $salt = RandomHelper::guid();
         $pwd = md5($password) . sha1($password);
         $hash = HashHelper::passwordHash($pwd, $salt);
         self::assertTrue(HashHelper::passwordVerify($pwd, $hash, $salt));

         $hash = HashHelper::passwordHash($password, $salt);
         self::assertTrue(HashHelper::passwordVerify($password, $hash, $salt));
      }
   }
}

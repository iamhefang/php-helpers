<?php

namespace link\hefang\helpers;


use PHPUnit\Framework\TestCase;

class TestRandomHelper extends TestCase
{
   public function testLETTERS()
   {
      self::assertEquals(
         RandomHelper::LETTERS('LDU'),
         RandomHelper::LOWERS . RandomHelper::DIGITS . RandomHelper::UPPERS
      );
      self::assertEquals(
         RandomHelper::LETTERS('DLU'),
         RandomHelper::DIGITS . RandomHelper::LOWERS . RandomHelper::UPPERS
      );
      self::assertEquals(
         RandomHelper::LETTERS('D'),
         RandomHelper::DIGITS
      );
      self::assertEquals(
         RandomHelper::LETTERS('U'),
         RandomHelper::UPPERS
      );
      self::assertEquals(
         RandomHelper::LETTERS('DU'),
         RandomHelper::DIGITS . RandomHelper::UPPERS
      );
   }

   public function testGuid()
   {
      $data = [];
      $max = 1000000;
      //测试生成max个guid会不会重复
      for ($i = 0; $i < $max; $i++) {
         $guid = RandomHelper::guid();
         //测试生成的guid是不是40位
         self::assertEquals(strlen($guid), 40);
         $data[$guid] = true;
      }
      self::assertEquals(count($data), $max);
   }
}

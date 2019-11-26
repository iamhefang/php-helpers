<?php


namespace link\hefang\guid;


use link\hefang\helpers\RandomHelper;
use PHPUnit\Framework\TestCase;

class TestGUKey extends TestCase
{
   public function testNext()
   {
      echo intval(microtime(true) * 1000);
      echo PHP_EOL;
      $guKey = new GUKey("PHP Unit Test");
      $key = $guKey->next();
      echo $key;
      echo PHP_EOL;
      self::assertEquals(strlen($key), 40);
   }

   public function testRepeat()
   {
      $buffer = [];
      $max = 1000000;
      $timeStart = microtime(true);
      $guKey = new GUKey(RandomHelper::guid());
      for ($i = 0; $i < $max; $i++) {
         $key = $guKey->next();
         $len = strlen($key);
         self::assertEquals($len, 40);
         $buffer[$key] = $len;
      }
      self::assertEquals(count($buffer), $max);
      echo "测试生成{$max}个key共用" . (microtime(true) - $timeStart) . "s" . PHP_EOL;
   }
}

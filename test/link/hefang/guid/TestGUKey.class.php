<?php


namespace link\hefang\guid;


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
}

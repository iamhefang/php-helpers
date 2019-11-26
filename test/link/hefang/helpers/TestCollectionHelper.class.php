<?php

namespace link\hefang\helpers;

use PHPUnit\Framework\TestCase;

class TestCollectionHelper extends TestCase
{
   private static $arr = ['b' => 1, 'a' => null, 'c' => ''];
   private static $arr1 = [1, 2, 3, 4, 5, 6, 7, 8, 9];

   public function testReduceDimension()
   {
      self::assertEquals(CollectionHelper::reduceDimension([1, 2, 3, 4, 5, [7, 8, 9, [10]]]), [1, 2, 3, 4, 5, 7, 8, 9, 10]);
      self::assertEquals(CollectionHelper::reduceDimension(['a' => 1, 'b' => 2, 'c' => ['d' => 3, 'e' => [4]]]), ['a' => 1, 'b' => 2, 'd' => 3, 'e' => 4]);
   }

   public function testGetOrDefault()
   {
      self::assertNull(CollectionHelper::getOrDefault(self::$arr, 'd'));
      self::assertEquals(CollectionHelper::getOrDefault(self::$arr, 'a'), null);
      self::assertEquals(CollectionHelper::getOrDefault(self::$arr, 'd', 11), 11);
   }

   public function testFirst()
   {
      self::assertEquals(CollectionHelper::first(self::$arr1), 1);
      self::assertEquals(CollectionHelper::first(self::$arr), 1);
      self::assertEquals(CollectionHelper::first(array_keys(self::$arr)), 'b');
      self::assertEquals(CollectionHelper::first(array_values(self::$arr)), 1);
   }

   public function testLast()
   {
      self::assertEquals(CollectionHelper::last(self::$arr1), 9);
      self::assertEquals(CollectionHelper::last(self::$arr), '');
      self::assertEquals(CollectionHelper::last(array_keys(self::$arr)), 'c');
      self::assertEquals(CollectionHelper::last(array_values(self::$arr)), '');
   }

}

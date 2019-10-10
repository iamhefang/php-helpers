<?php

namespace link\hefang\helpers;
defined("PHP_HELPERS") or die(1);


final class CollectionHelper
{
   public static function getOrDefault($array, string $key, $defaultValue = null)
   {
      return is_array($array) && array_key_exists($key, $array) ? $array[$key] : $defaultValue;
   }

   /**
    * 获取数组第一个元素
    * @param array $array
    * @param $defaultValue mixed 默认值
    * @return mixed
    */
   public static function first($array, $defaultValue = null)
   {
      if (!is_array($array)) return $defaultValue;
      foreach ($array as $key => $value) {
         return $value;
      }
      return $defaultValue;
   }


   /**
    * 获取数组最后一个元素
    * @param array $array
    * @param $defaultValue mixed 默认值
    * @return mixed
    */
   public static function last($array, $defaultValue = null)
   {
      if (!is_array($array) || empty($array)) return $defaultValue;
      $keys = array_keys($array);
      return $array[$keys[count($keys) - 1]];
   }


   /**
    * CollectionHelper constructor.
    */
   private function __construct()
   {
   }
}

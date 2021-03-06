<?php

namespace link\hefang\helpers;

defined("PHP_HELPERS") or die(1);


final class CollectionHelper
{
   /**
    * 索引数组降维
    * @param array $array
    * @return array
    */
   public static function reduceDimension(array $array): array
   {
      $result = [];
      foreach (array_values($array) as $key => $value) {
         if (is_array($value)) {
            $result = array_merge($result, self::reduceDimension($value));
         } else {
            $result[] = $value;
         }
      }
      return $result;
   }

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
    * 将php数组转换为php文件
    * @param array $array
    * @return string
    */
   public static function stringify(array $array): string
   {
      return "[" . join(",", array_map(function ($key, $value) {
            return json_encode($key, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "=>" . (is_array($value) ? self::stringify($value) : json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
         }, array_keys($array), array_values($array))) . "]";
   }

   /**
    * CollectionHelper constructor.
    */
   private function __construct()
   {
   }
}

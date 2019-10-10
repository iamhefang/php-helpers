<?php

namespace link\hefang\helpers;


final class TimeHelper
{
   const  SMALL_MONTH = [4, 6, 9, 11];

   public static function currentTimeMillis(): float
   {
      return floor(microtime(true) * 1000);
   }

   /**
    * 格式化时间
    * @param string $format 格式
    * @param float $timeMillis 毫秒级时间戳, 默认为当前时间
    * @return false|string
    */
   public static function formatMillis(string $format = "Y-m-d H:i:s", float $timeMillis = -1)
   {
      $timeMillis = floor($timeMillis);
      if ($timeMillis < 0) $timeMillis = self::currentTimeMillis();
      return date($format, $timeMillis / 1000);
   }

   /**
    * 计算某年[某月]共多少天
    * @param int $year 年
    * @param int|null $month 月
    * @return int 天数
    */
   public static function daysOf(int $year, int $month = null): int
   {
      $isLeapYear = self::isLeapYear($year);
      if ($month === null) {
         return $isLeapYear ? 366 : 365;
      } else {
         return in_array($month, self::SMALL_MONTH) ? 30 : ($month === 2 ? ($isLeapYear ? 29 : 28) : 31);
      }
   }

   /**
    * 判断某年是否为润年
    * @param int $year 年
    * @return bool 是否润年
    */
   public static function isLeapYear(int $year): bool
   {
      return ($year % 4 == 0 || $year % 100 == 0) && $year % 400 != 0;
   }

   private function __construct()
   {
   }
}

<?php


namespace link\hefang\guid;


use link\hefang\helpers\RadixHelper;
use link\hefang\helpers\RandomHelper;

class GUKey
{
   const VERSION = 1;
   private $nameCode = "";
   private $versionCode = "";
   private $machineIdCode = "";


   public function __construct(string $name = null, int $machineID = 0)
   {
      $name or $name = RandomHelper::guid();

      $nameCodeValue = 0;
      for ($i = 0; $i < strlen($name); $i++) {
         $nameCodeValue += ord($name{$i});
      }
      $this->nameCode = substr(RadixHelper::dec2radix($nameCodeValue, 36) . RandomHelper::string(10, RandomHelper::LETTERS('LD')), 0, 10);
      $this->versionCode = RadixHelper::dec2radix(self::VERSION, 36);
      $this->machineIdCode = str_pad(RadixHelper::dec2radix($machineID, 36), 2, "0", STR_PAD_LEFT);
   }

   public function next()
   {
      return join("", [
         $this->versionCode, // 程序版本, 1位
         $this->machineIdCode, // 服务器机器编号, 2位
         RadixHelper::dec2radix(microtime(true) * 1000, 36), // 36进制毫秒级当前时间, 8位
         $this->nameCode, // 种子, 10位
         RandomHelper::string(10, RandomHelper::LETTERS("LD")), //随机字符串, 10位
      ]);
   }
}

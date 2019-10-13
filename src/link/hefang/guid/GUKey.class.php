<?php


namespace link\hefang\guid;


use link\hefang\helpers\CollectionHelper;
use link\hefang\helpers\RadixHelper;
use link\hefang\helpers\RandomHelper;

class GUKey
{
   const VERSION = 1;
   private $nameCode = "";
   private $versionCode = "";
   private $machineIdCode = "";
   private $serverInfoCode = "";


   /**
    * GUKey constructor.
    * @param string|null $name 种子, 或不指定则使用随机数
    * @param int $machineID 生成key的机器编号
    */
   public function __construct(string $name = null, int $machineID = 0)
   {
      $name or $name = RandomHelper::guid();

      $nameCodeValue = 0;
      for ($i = 0; $i < strlen($name); $i++) {
         $nameCodeValue += ord($name{$i});
      }
      $this->nameCode = substr(RadixHelper::dec2radix($nameCodeValue, 36) . $this->rand36number(), 0, 10);
      $this->versionCode = RadixHelper::dec2radix(self::VERSION, 36);
      $this->machineIdCode = str_pad(RadixHelper::dec2radix($machineID, 36), 2, "0", STR_PAD_LEFT);
      $this->serverInfoCode = substr(md5(join("", CollectionHelper::reduceDimension($_SERVER))), 0, 9);
   }

   /**
    * 生成10位36进制数
    * @return string
    */
   private function rand36number(): string
   {
      return substr(RadixHelper::dec2radix(rand(1000000000000000, PHP_INT_MAX), 36), 0, 10);
   }

   /**
    * 生成一个gukey
    * @return string 结果
    */
   public function next(): string
   {
      return join("", [
         $this->versionCode, // 程序版本, 1位
         $this->machineIdCode, // 服务器机器编号, 2位
         RadixHelper::dec2radix(microtime(true) * 1000, 36), // 36进制毫秒级当前时间, 8位
         $this->nameCode, // 种子, 10位
         $this->rand36number(),//随机字符串, 10位
         $this->serverInfoCode // 服务器信息, 9位
      ]);
   }
}

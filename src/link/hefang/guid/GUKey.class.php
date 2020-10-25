<?php


namespace link\hefang\guid;


use link\hefang\helpers\CollectionHelper;
use link\hefang\helpers\RandomHelper;
use link\hefang\helpers\StringHelper;

class GUKey
{
   const VERSION = 1;
   private $nameCode;
   private $versionCode;
   private $machineIdCode;
   private $serverInfoCode;

   /**
    * 判断一个字符串是否为GuKey
    * @param  $key string
    * @return bool
    */
   public static function isGuKey(string $key): bool
   {
      return !StringHelper::isNullOrBlank($key) && strlen($key) === 40;
   }

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
      $this->nameCode = substr(base_convert($nameCodeValue, 10, 36) . $this->rand36number(), 0, 10);
      $this->versionCode = base_convert(self::VERSION, 10, 36);
      $this->machineIdCode = str_pad(base_convert($machineID, 10, 36), 2, "0", STR_PAD_LEFT);
      $this->serverInfoCode = substr(md5(join("", CollectionHelper::reduceDimension($_SERVER))), 0, 9);
   }

   /**
    * 生成10位36进制数
    * @return string
    */
   private function rand36number(): string
   {
      return substr(base_convert(rand(1000000000000000, PHP_INT_MAX), 10, 36), 0, 10);
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
         base_convert(microtime(true) * 1000, 10, 36), // 36进制毫秒级当前时间, 8位
         $this->nameCode, // 种子, 10位
         $this->rand36number(),//随机字符串, 10位
         $this->serverInfoCode // 服务器信息, 9位
      ]);
   }
}

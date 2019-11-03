<?php

namespace link\hefang\helpers;

use link\hefang\crypt\Des;

defined("PHP_HELPERS") or die(1);

final class HashHelper
{
   /**
    * des加密
    * @param string $data 要加密的数据
    * @param string $key 密码
    * @return string 结果
    */
   public static function desEncrypt(string $data, string $key): string
   {
      $des = new Des();
      return $des->encrypt($data, $key);
   }

   /**
    * des解密
    * @param string $data 要解密的数据
    * @param string $key 密码
    * @return string 解密后的结果
    */
   public static function desDecrypt(string $data, string $key): string
   {
      $des = new Des();
      return $des->decrypt($data, $key);
   }

   /**
    * 计算密码hash
    * @param string $pwd 密码
    * @param string $salt 加密时使用的盐
    * @return string 40位 hash 密码
    */
   public static function passwordHash(string $pwd, string $salt = ""): string
   {
      return sha1(md5($pwd) . sha1($pwd) . $salt ?: "");
   }

   /**
    * @param string $pwd 原始密码
    * @param string $hash hash密码
    * @param string $salt 加密时使用的盐
    * @return bool
    */
   public static function passwordVerify(string $pwd, string $hash, string $salt = ''): bool
   {
      if (StringHelper::isNullOrBlank($hash) || StringHelper::isNullOrBlank($pwd)) return false;
//      $pwd = sha1($password) . md5($password);
      return self::passwordHash($pwd, $salt) === $hash;
   }

   /**
    * HashHelper constructor.
    */
   private function __construct()
   {
   }
}

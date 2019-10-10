<?php

namespace link\hefang\helpers;
defined("PHP_HELPERS") or die(1);

final class ClassHelper
{
   private static $loaderRegistered = false;
   private static $classPaths = [];
   private static $useRequire = true;

   /**
    * 设置加载类文件的时候使用'require'
    * @param bool $useRequire true: 使用'require' false: 使用'include'
    */
   public static function setUseRequire(bool $useRequire = true)
   {
      self::$useRequire = $useRequire;
   }

   /**
    * 设置类自动加载路径,
    * @param string $classPath [optional] 绝对路径
    */
   public static function loader(string $classPath)
   {
      self::$classPaths = array_merge(self::$classPaths, func_get_args());
      if (self::$loaderRegistered) return;
      spl_autoload_register(function (string $class) {
         foreach (self::$classPaths as $classPath) {
            $file = $classPath . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".class.php";
            if (!is_file($file) || !is_readable($file)) continue;
            if (self::$useRequire) {
               require $file;
            } else {
               include $file;
            }
         }
      }, true);
      self::$loaderRegistered = true;
   }

   /**
    * @return array
    */
   public static function getClassPaths(): array
   {
      return array_merge([], self::$classPaths);
   }

   /**
    * 获取指定目录或phar文件中的类
    * 1. 类命名空间必须和目录结构一致
    * 2. 类文件中只能包含一个类
    * 3. 类文件名必须和类名完全一致且以小写字母 .class.php 做为后缀
    * @param string $fileOrDir
    * @return array
    */
   public static function findClassesIn(string $fileOrDir): array
   {
      if (!file_exists($fileOrDir)) {
         return [];
      }
      if (is_file($fileOrDir) &&
         StringHelper::endsWith($fileOrDir, true, ".phar") &&
         !StringHelper::startsWith($fileOrDir, true, "phar://")) {
         return self::findClassesIn("phar://" . $fileOrDir);
      }
      if (is_dir($fileOrDir)) {
         $fileOrDir = FileHelper::appendDirSeparator($fileOrDir);
         $classFiles = FileHelper::listFiles($fileOrDir, function (string $file) {
            return StringHelper::endsWith($file, false, ".class.php");
         });

         foreach ($classFiles as &$file) {
            $file = str_replace($fileOrDir, "", $file);
            $file = str_replace(DIRECTORY_SEPARATOR, "\\", $file);
            $file = str_replace(".class.php", "", $file);
         }

         return $classFiles;
      }
      return [];
   }

   private function __construct()
   {

   }
}

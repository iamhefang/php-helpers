<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/5
 * Time: 10:17
 */

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

    private function __construct()
    {

    }
}
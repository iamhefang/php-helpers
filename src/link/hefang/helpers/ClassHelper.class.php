<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/5
 * Time: 10:17
 */

namespace link\hefang\helpers;
defined("PHP_HELPERS") or die(1);

class ClassHelper
{
    private static $loaderRegistered = false;
    private static $classPaths = [];
    private static $useRequire = true;

    public static function setUseRequire(bool $useRequire = true)
    {
        self::$useRequire = $useRequire;
    }

    /**
     * @param string $classPath [optional]
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
    }

    private function __construct()
    {

    }
}
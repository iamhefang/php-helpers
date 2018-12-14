<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/3
 * Time: 16:47
 */

namespace link\hefang\helpers;
defined("PHP_HELPERS") or die(1);

use link\hefang\exceptions\CanNotNullException;

final class ObjectHelper
{

    /**
     * @param $var mixed 检查对象是否为null 相当于 java 的 @NotNull 或 @NonNull 注解
     * @param string|null $name
     */
    public static function checkNull($var, string $name = null)
    {
        if ($var === null) throw new CanNotNullException($name || "变量");
    }

    /**
     * 如果$var为null返回默认值, 否则返回 var 本身
     * 如何默认值也为null则抛出异常
     * @param $var
     * @param $defaultValue mixed
     * @return mixed
     */
    public static function nullOrDefault($var, $defaultValue)
    {
        return $var === null ? $defaultValue : $var;
    }

    /**
     * ObjectHelper constructor.
     */
    private function __construct()
    {
    }
}
<?php
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
     * @param string $class
     * @param string $name
     * @return \ReflectionProperty
     * @throws \ReflectionException
     */
    public static function getProperty(string $class, string $name): \ReflectionProperty
    {
        $ref = new \ReflectionClass($class);
        return self::fetchProperty($ref, $name);
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @param string $name
     * @return \ReflectionProperty
     * @throws \ReflectionException
     */
    public static function fetchProperty(\ReflectionClass $reflectionClass, string $name): \ReflectionProperty
    {
        $field = null;
        while (true) {
            try {
                $field = $reflectionClass->getProperty($name);
                break;
            } catch (\Throwable $e) {
                $reflectionClass = $reflectionClass->getParentClass();
                if (!$reflectionClass) break;
            }
        }
        if ($field === null) {
            throw new \ReflectionException("Property '$name' does not exist");
        }
        return $field;

    }

    /**
     * @param string $class
     * @param callable|null $filter
     * @return array
     * @throws \ReflectionException
     */
    public static function getProperties(string $class, $filter = null): array
    {
        $ref = $ref = new \ReflectionClass($class);
        return self::fetchProperties($ref, $filter);
    }

    public static function fetchProperties(\ReflectionClass $reflectionClass, $filter = null): array
    {
        $res = [];
        while (true) {
            try {
                $res = array_merge($res, $reflectionClass->getProperties($filter));
            } catch (\Throwable $exception) {
                $reflectionClass = $reflectionClass->getParentClass();
                if (!$reflectionClass) break;
            }
        }
        return $res;
    }

    /**
     * ObjectHelper constructor.
     */
    private function __construct()
    {
    }
}
<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/3
 * Time: 10:54
 */

namespace link\hefang\helpers;
defined("PHP_HELPERS") or die(1);

final class CollectionHelper
{
    public static function getOrDefault($array, string $key, $defaultValue = null)
    {
        return is_array($array) && array_key_exists($key, $array) ? $array[$key] : $defaultValue;
    }

    /**
     * 获取数组第一个元素
     * @param array $array
     * @param $defaultValue mixed 默认值
     * @return mixed
     */
    public static function first($array, $defaultValue = null)
    {
        if (!is_array($array)) return $defaultValue;
        return empty($array) ? $defaultValue : $array[0];
    }


    /**
     * 获取数组最后一个元素
     * @param array $array
     * @param $defaultValue mixed 默认值
     * @return mixed
     */
    public static function last($array, $defaultValue = null)
    {
        if (!is_array($array)) return $defaultValue;
        return empty($array) ? $defaultValue : $array[count($array) - 1];
    }


    /**
     * CollectionHelper constructor.
     */
    private function __construct()
    {
    }
}
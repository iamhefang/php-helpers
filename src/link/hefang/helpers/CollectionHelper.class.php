<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/3
 * Time: 10:54
 */

namespace link\hefang\helpers;
defined("PHP_HELPERS") or die(1);

class CollectionHelper
{
    public static function getOrDefault(array $array, string $key, $defaultValue = null)
    {
        return is_array($array) && array_key_exists($key, $array) ? $array[$key] : $defaultValue;
    }

    /**
     * CollectionHelper constructor.
     */
    private function __construct()
    {
    }
}
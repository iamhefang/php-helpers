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

class ObjectHelper
{

    public static function checkNull($var)
    {
        if ($var === null) throw new CanNotNullException($var);
    }

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
<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/3
 * Time: 11:16
 */

namespace link\hefang\exceptions;
defined("PHP_HELPERS") or die(1);

class CanNotNullException extends \RuntimeException
{

    /**
     * CanNotNullException constructor.
     * @param null $var
     */
    public function __construct($var)
    {
        parent::__construct("{$var}不能为null");
    }
}
<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/3
 * Time: 08:45
 */

namespace link\hefang\exceptions;
defined("PHP_HELPERS") or die(1);

class ClassNotFoundException extends \Exception
{

    /**
     * ClassNotFoundException constructor.
     * @param string $class
     */
    public function __construct(string $class)
    {
        parent::__construct("类'$class'找不到");
    }
}
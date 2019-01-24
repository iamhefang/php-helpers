<?php

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
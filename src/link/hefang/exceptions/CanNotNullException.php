<?php

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

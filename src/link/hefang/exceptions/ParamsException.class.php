<?php


namespace link\hefang\exceptions;


class ParamsException extends \RuntimeException
{

    /**
     * ParamsException constructor.
     * @param string $string
     */
    public function __construct(string $string)
    {
        parent::__construct($string);
    }
}
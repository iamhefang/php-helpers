<?php

namespace link\hefang\exceptions;
defined("PHP_HELPERS") or die(1);

class FileNotFoundException extends IOException
{
    /**
     * FileNotFoundException constructor.
     * @param string $filename
     */
    public function __construct($filename)
    {
    }
}
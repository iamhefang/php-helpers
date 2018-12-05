<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/3
 * Time: 07:55
 */

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
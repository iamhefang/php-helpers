<?php

namespace link\hefang\exceptions;


class ExtensionNotLoadException extends \RuntimeException
{

    /**
     * ExtensionNotLoadException constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct("扩展'zip'未加载, 无法使用该功能");
    }
}
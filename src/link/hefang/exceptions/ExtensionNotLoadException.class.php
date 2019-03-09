<?php

namespace link\hefang\exceptions;


class ExtensionNotLoadException extends \RuntimeException
{
    public function __construct(string $name)
    {
        parent::__construct("扩展'{$name}'未加载, 无法使用该功能");
    }
}
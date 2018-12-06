<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/6
 * Time: 10:02
 */

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
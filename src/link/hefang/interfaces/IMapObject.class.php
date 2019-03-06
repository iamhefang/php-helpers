<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/3
 * Time: 14:21
 */

namespace link\hefang\interfaces;
defined("PHP_HELPERS") or die(1);

interface IMapObject
{
    public function toMap(): array;
}
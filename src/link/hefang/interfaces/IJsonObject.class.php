<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/3
 * Time: 14:19
 */

namespace link\hefang\interfaces;
defined("PHP_HELPERS") or die(1);

interface IJsonObject
{
    public function toJsonString(): string;
}
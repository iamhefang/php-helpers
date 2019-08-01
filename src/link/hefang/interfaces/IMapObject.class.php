<?php
namespace link\hefang\interfaces;
defined("PHP_HELPERS") or die(1);

interface IMapObject
{
    public function toMap(): array;
}
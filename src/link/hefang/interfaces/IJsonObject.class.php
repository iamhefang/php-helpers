<?php

namespace link\hefang\interfaces;
defined("PHP_HELPERS") or die(1);

interface IJsonObject
{
   public function toJsonString(): string;
}

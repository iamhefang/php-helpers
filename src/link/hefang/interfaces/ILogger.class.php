<?php

namespace link\hefang\interfaces;
defined("PHP_HELPERS") or die(1);

use link\hefang\enums\LogLevel;
use Throwable;

interface ILogger
{
   public function getLevel(): LogLevel;

   public function setLevel(LogLevel $level);

   public function log($content, string $title = null);

   public function notice($content, string $title = null);

   public function warn($content, string $title = null, Throwable $e = null);

   public function error($content, string $title = null, Throwable $e = null);

   public function debug($content, string $title = null);
}

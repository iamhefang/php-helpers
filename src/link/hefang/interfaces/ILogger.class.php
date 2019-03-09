<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/3
 * Time: 09:14
 */

namespace link\hefang\interfaces;
defined("PHP_HELPERS") or die(1);

use link\hefang\enums\LogLevel;

interface ILogger
{
    public function getLevel(): LogLevel;

    public function setLevel(LogLevel $level);

    public function log($content, string $title = null);

    public function notice($content, string $title = null);

    public function warn($content, string $title = null, \Throwable $e = null);

    public function error($content, string $title = null, \Throwable $e = null);

    public function debug($content, string $title = null);
}
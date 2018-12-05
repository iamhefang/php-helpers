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

    public function log(string $title, string $content);

    public function notice(string $title, string $content);

    public function warn(string $title, string $content, \Exception $e = null);

    public function error(string $title, string $content, \Exception $e = null);

    public function debug(string $title, string $content);
}
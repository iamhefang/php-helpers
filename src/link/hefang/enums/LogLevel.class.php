<?php
namespace link\hefang\enums;
defined("PHP_HELPERS") or die(1);

class LogLevel
{
    const NONE = 0;
    const NOTICE = 1;
    const WARN = 2;
    const ERROR = 3;
    const ALL = 4;

    public static function none()
    {
        return new LogLevel(LogLevel::NONE);
    }

    public static function notice()
    {
        return new LogLevel(LogLevel::NOTICE);
    }

    public static function warn()
    {
        return new LogLevel(LogLevel::WARN);
    }

    public static function error()
    {
        return new LogLevel(LogLevel::ERROR);
    }

    public static function all()
    {
        return new LogLevel(LogLevel::ALL);
    }


    private $value;

    /**
     * LogLevel constructor.
     * @param int $level
     */
    private function __construct(int $level)
    {
        $this->value = $level;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param string|int $nameOrValue
     * @return LogLevel
     */
    public static function valueOf($nameOrValue)
    {
        $map = [
            self::none(),
            self::notice(),
            self::warn(),
            self::error(),
            self::all(),

            "NONE" => self::none(),
            "NOTICE" => self::notice(),
            "WARN" => self::warn(),
            "ERROR" => self::error(),
            "ALL" => self::all(),
        ];
        return array_key_exists($nameOrValue, $map) ? $map[$nameOrValue] : null;
    }

}
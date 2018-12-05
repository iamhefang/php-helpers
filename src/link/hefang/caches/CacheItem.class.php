<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/4
 * Time: 08:22
 */

namespace link\hefang\caches;
defined("PHP_HELPERS") or die(1);

class CacheItem
{
    private $value = null;
    private $expireIn = 0;

    /**
     * CacheItem constructor.
     * @param null $value
     * @param int $expireIn
     */
    public function __construct($value, int $expireIn)
    {
        $this->value = $value;
        $this->expireIn = $expireIn;
    }

    public static function fromSerializedString(string $string): CacheItem
    {
        $res = unserialize($string);
        if (!$res) {
            return new CacheItem("", 1);
        }
        return $res;
    }

    /**
     * @return null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param null $value
     * @return CacheItem
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpireIn(): int
    {
        return $this->expireIn;
    }

    /**
     * @param int $expireIn
     * @return CacheItem
     */
    public function setExpireIn(int $expireIn): CacheItem
    {
        $this->expireIn = $expireIn;
        return $this;
    }

}
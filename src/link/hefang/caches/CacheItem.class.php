<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/4
 * Time: 08:22
 */

namespace link\hefang\caches;

use link\hefang\helpers\CollectionHelper;

defined("PHP_HELPERS") or die(1);

class CacheItem implements \Serializable
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
        return unserialize($string);
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

    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize(["value" => $this->value, "expireIn" => $this->expireIn]);
    }

    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        $tmp = unserialize($serialized);
        $this->value = CollectionHelper::getOrDefault($tmp, 'value');
        $this->expireIn = CollectionHelper::getOrDefault($tmp, 'expireIn');
    }
}
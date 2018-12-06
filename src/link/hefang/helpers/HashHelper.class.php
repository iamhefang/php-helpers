<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/3
 * Time: 17:31
 */

namespace link\hefang\helpers;
defined("PHP_HELPERS") or die(1);

final class HashHelper
{
    /**
     * @param string $pwd 前端使用 <code>sha1(password) + md5(password)</code> hash 过的72位密码
     * @param string $salt 加密时使用的盐
     * @return string 40位 hash 密码
     */
    public static function passwordHash(string $pwd, string $salt = ''): string
    {
        return sha1(md5($pwd) . sha1($pwd) . $salt);
    }

    /**
     * @param string $password 原始密码
     * @param string $hash hash密码
     * @param string $salt 加密时使用的盐
     * @return bool
     */
    public static function passwordVerify(string $password, string $hash, string $salt = ''): bool
    {
        if (StringHelper::isNullOrBlank($hash) || StringHelper::isNullOrBlank($password)) return false;
        $pwd = sha1($password) + md5($password);
        return self::passwordHash($pwd, $salt) === $hash;
    }

    /**
     * HashHelper constructor.
     */
    private function __construct()
    {
    }
}
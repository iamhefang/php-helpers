<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2018/12/4
 * Time: 08:12
 */

namespace link\hefang\interfaces;
defined("PHP_HELPERS") or die(1);

interface ICache
{
    /**
     * ICache constructor.
     * @param string $option 缓存选项, 缓存的实现类所需的选项不一定相同.
     * 参数为 string 类型, 实现缓存类时可自行把参数做为 json 或 xml 解析
     */
    public function __construct(string $option = null);

    /**
     * 读取缓存
     * @param string $name 名称
     * @param null|mixed $defaultValue 默认值
     * @return mixed 缓存值, 缓存池中没有值时返回默认值
     */
    public function get(string $name, $defaultValue = null);

    /**
     * 设置缓存
     * @param string $name 名称
     * @param mixed $value 值
     * @param int $expireIn 过期时间, 秒级时间戳
     * @return void
     */
    public function set(string $name, $value, int $expireIn = -1);

    /**
     * 判断缓存是否存在
     * @param string $name 名称
     * @return bool 是否存在
     */
    public function exist(string $name): bool;

    /**
     * 删除缓存
     * @param string $name 名称
     * @return mixed 删除的缓存的值, 若缓存不存在返回null
     */
    public function remove(string $name);

    /**
     * 清空所有缓存
     * @return bool 是否成功
     */
    public function clean(): bool;

    /**
     * 获取所有缓存名称
     * @return array 名称数组
     */
    public function names(): array;

    /**
     * 获取可用缓存数量
     * @return int 缓存数量
     */
    public function count(): int;
}
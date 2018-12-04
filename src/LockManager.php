<?php

namespace Hormone\Lock;

use Hormone\Lock\Config\LockConfig;
use Hormone\Lock\Exception\LockException;

/**
 * 内存锁管理
 *
 * @author dusong<1264735045@qq.com>
 */
class LockManager
{
    /**
     * 适配器
     *
     * @var null
     */
    protected static $adapter = null;

    /**
     * 初始化配置
     *
     * @param object $client
     * @param array  $config
     */
    public static function init($client, array $config = [])
    {
        LockConfig::init($config);

        static::setLockAdapter($client);
    }

    /**
     * 设置适配器
     *
     * @param  object   $client
     * @throws LockException
     */
    protected static function setLockAdapter($client)
    {
        $adapterConfig = LockConfig::getAdapterConfig();
        if (empty($adapterConfig)) {
            throw new LockException('get lock adapter exception');
        }

        static::$adapter = new $adapterConfig['class']($client);
    }

    /**
     * 获取适配器
     *
     * @return LockInterface
     */
    public static function getLockAdapter(): LockInterface
    {
        return static::$adapter;
    }

    /**
     * 获取内存锁
     *
     * @param  string $lock_key
     * @return mixed
     */
    public static function acquire(string $lock_key)
    {
        return static::getLockAdapter()->acquire($lock_key);
    }

    /**
     * 释放内存锁
     *
     * @param  string $lock_key
     * @return mixed
     */
    public static function release(string $lock_key)
    {
        return static::getLockAdapter()->release($lock_key);
    }
}

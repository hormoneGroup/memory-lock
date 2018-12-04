<?php

namespace Hormone\Lock\Adapter;

use Hormone\Lock\Config\LockConfig;
use Hormone\Lock\Exception\LockException;
use Hormone\Lock\Exception\MemcacheLockException;
use Hormone\Lock\LockInterface;

/**
 * memcache内存锁适配器
 *
 * @author dusong<1264735045@qq.com>
 */
class MemcacheAdapter implements LockInterface
{
    /**
     * memcache对象
     *
     * @var Object
     */
    private $memcache = null;

    /**
     * 构造函数
     *
     * @param object $memcache
     */
    public function __construct($memcache)
    {
        $this->memcache = $memcache;
    }

    /**
     * 获取内存锁key
     *
     * @param  string $lockKey
     * @return string
     */
    protected function getLockKey(string $lockKey)
    {
        return LockConfig::getConfig()['lockPrefix'] . $lockKey;
    }

    /**
     * 获取内存锁
     *
     * @param  string $lockKey
     * @return mixed
     * @throws LockException
     */
    public function acquire(string $lockKey)
    {
        $lockConfig = LockConfig::getConfig();
        $lockKey    = $this->getLockKey($lockKey);

        $i = 0;
        do {
            $lock = $this->memcache->add($lockKey, 1, $lockConfig['lockTimeout']);

            // 如果第一次没有获取到锁则等待指定时间后重试
            if ($i > 0) {
                usleep($lockConfig['lockTimewait']);
            }

            $i++;

            // 超过重试次数后退出
            if ($i >  $lockConfig['lockRetryTimes']) {
                throw new MemcacheLockException('memory locking failure');
            }
        } while(!$lock);

        return $lock;
    }

    /**
     * 释放内存锁
     *
     * @param  string $lockKey
     * @return bool
     */
    public function release(string $lockKey)
    {
        $lockKey = $this->getLockKey($lockKey);

        return $this->memcache->delete($lockKey);
    }
}

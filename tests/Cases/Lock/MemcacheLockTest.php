<?php

namespace HormoneTest\Lock\Lock;

use Hormone\Lock\Config\LockConfig;
use HormoneTest\Lock\AbstractTestCase;

/**
 * redis内存锁测试
 *
 * @author dusong<1264735045@qq.com>
 */
class MemcacheLockTest extends AbstractTestCase
{
    /**
     * @test
     */
    public function test()
    {
        try {
            $memcached = new \Memcached([
                'servers' => array('127.0.0.1:11211'),
            ]);
            \Hormone\Lock\LockManager::init($memcached, [
                'adapter' => LockConfig::MEMCACHE_ADAPTER,
            ]);

            $key = 'lockKey2';
            \Hormone\Lock\LockManager::acquire($key);

            // do something
            var_dump("code");
            sleep(1);

        } catch (\Exception $e) {
            // todo Exception

        } finally {
            \Hormone\Lock\LockManager::release($key);
        }
        $this->assertTrue(true);
    }
}
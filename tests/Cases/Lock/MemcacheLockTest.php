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
        $this->assertTrue(true);
    }
}
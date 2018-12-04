<?php

namespace Hormone\Lock;

/**
 * 内存锁接口
 *
 * @author dusong<1264735045@qq.com>
 */
interface LockInterface
{
    /**
     * 获取内存锁
     *
     * @param  string $lock_key
     * @return mixed
     */
    public function acquire(string $lock_key);

    /**
     * 释放内存锁
     *
     * @param  string $lock_key
     * @return mixed
     */
    public function release(string $lock_key);
}

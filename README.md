# PHP /memory-lock

php 内存锁

## Install

- composer command

```bash
composer require hormone/memory-lock
```

## Document

### use redis lock

```php
<?php
require 'vendor/autoload.php';

  try {
            $redis = new \Redis();
            $redis->connect('127.0.0.1', 6379);
            
            $config = [
                 // 适配器类型
                //'adapter'         => \Hormone\Lock\Config\LockConfig::REDIS_ADAPTER,
        
                // 内存锁获取时重试等待时间，单位为微秒。默认等待10ms，系统压力比较大，可以适当增大该时间值
                //'lockTimewait'    => 10000,
        
                // 设置重试次数，以保证不会到达PHP超时时间
                //'lockRetryTimes'  => 1000,
        
                // 内存锁过期时间，需要大于PHP脚本默认的超时时间30s
                //'lockTimeout'     => 35,
        
                //'lockPrefix'      => '_hm_lock_',
            ];
            \Hormone\Lock\LockManager::init($redis, $config);
    
            $key = 'lockKey1';
            \Hormone\Lock\LockManager::acquire($key);
            
            // do something
            var_dump("code");
            sleep(1);

        } catch (\Exception $e) {
            // todo Exception

        } finally {
            \Hormone\Lock\LockManager::release($key);
        }
```

### use memcached lock

```php
<?php
require 'vendor/autoload.php';

   try {
              $memcached = new \Memcached([
                  'servers' => array('127.0.0.1:11211'),
              ]);
              
               $config = [
                   // 适配器类型
                  //'adapter'         => \Hormone\Lock\Config\LockConfig::MEMCACHE_ADAPTER,
          
                  // 内存锁获取时重试等待时间，单位为微秒。默认等待10ms，系统压力比较大，可以适当增大该时间值
                  //'lockTimewait'    => 10000,
          
                  // 设置重试次数，以保证不会到达PHP超时时间
                  //'lockRetryTimes'  => 1000,
          
                  // 内存锁过期时间，需要大于PHP脚本默认的超时时间30s
                  //'lockTimeout'     => 35,
          
                  //'lockPrefix'      => '_hm_lock_',
              ];
                          
              \Hormone\Lock\LockManager::init($memcached, $config);
  
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
```

## Unit testing

```bash
./vendor/bin/phpunit tests or composer test
```

## LICENSE

The Component is open-sourced software licensed under the [Apache license](LICENSE).

<?php

if (file_exists($file = dirname(__DIR__, 3) . '/autoload.php')) {
    require_once $file;
} elseif (file_exists($file = dirname(__DIR__) . '/vendor/autoload.php')) {
    require_once $file;
} else {
    exit('OO, The composer autoload file is not found!');
}

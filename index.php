<?php

define('ROOT_DIR', __DIR__ . '/');

include ROOT_DIR . 'system/Boot.php';

System\Boot::init();

// 初始化
System\App::init();

System\Plugin::factory('index.php')->run();

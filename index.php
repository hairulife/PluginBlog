<?php
define('ROOT_DIR', __DIR__ . '/');

if (!@include_once ROOT_DIR . 'config.php') {
    file_exists('./install.php') ?  header('Location: install.php') : print('Missing config file');
    exit;
}

App\Boot::init();

System\Plugin::factory('index.php')->run();

echo '<br>已启用的插件：<br><pre>';
print_r(System\Plugin::export());

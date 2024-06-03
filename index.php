<?php
define('ROOT_DIR', __DIR__ . '/');

if (!@include_once ROOT_DIR . 'config.php') {
    file_exists('./install.php') ?  header('Location: install.php') : print('Missing config file');
    exit;
}

System\Plugin::factory('index.php')->run();

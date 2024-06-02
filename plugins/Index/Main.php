<?php

namespace Plugins\Index;

use System\Plugin;

class Main
{
    public static function enable()
    {
        Plugin::factory('index.php')->run = __CLASS__ . '::scheduler';
        Plugin::factory(__CLASS__)->view = __CLASS__ . '::view';
    }

    public static function disable()
    {
    }

    public static function config()
    {
    }

    public static function view()
    {
        echo '首页';
    }

    public static function scheduler()
    {
        $path =  \System\Request::getPath();
        $name = \Helpers\Utils::toCamelCase(explode('/', $path)[1]) ?: 'Index';

        $handler = \Helpers\Utils::getFullPluginName($name);

        if (!\System\Plugin::exists($name) || !\System\Plugin::existsHandler($handler . ':view')) {
            $handler = \Helpers\Utils::getFullPluginName('Error');
        }

        \System\Plugin::factory($handler)->view();
    }
}

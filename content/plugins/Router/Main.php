<?php

namespace Content\Plugins\Index;

use System\Plugin;

class Main
{
    /**
     * 启用插件
     *
     * @return void
     */
    public static function activate()
    {
        Plugin::factory('index.php')->run = __CLASS__ . '::router';
        Plugin::factory(__CLASS__)->run = __CLASS__ . '::render';
    }

    public static function deactivate()
    {
    }

    public static function config()
    {
    }

    public static function render()
    {
        echo '首页';
    }


    public static function router()
    {
        $path =  \System\Request::getPath();
        $name = \Helpers\Utils::toCamelCase(explode('/', $path)[1]) ?: 'Index';

        $handler = \Helpers\Utils::getFullPluginName($name);
        if (!\System\Plugin::exists($name) || !\System\Plugin::existsHandler($handler . ':run')) {
            $handler = \Helpers\Utils::getFullPluginName('Error');
        }


        \System\Plugin::factory($handler)->run();
    }
}

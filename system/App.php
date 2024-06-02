<?php

namespace System;

use System\Plugin;

class App
{
    public static function init()
    {
        set_exception_handler(array(__CLASS__, 'exceptionHandler'));

        // 初始化插件
        Plugin::init([
            // 'HelloWorld' => [
            //     'config' => [],
            //     'handles' => [
            //         'index.php:start' => [
            //             'Plugins\HelloWorld\Main::render'
            //         ]
            //     ]
            // ],
        ]);

        // 激活插件
        \Plugins\HelloWorld\Main::enable();
        // 获取插件配置
        $renderer = new \Helpers\Renderer();
        \Plugins\HelloWorld\Main::config($renderer);
        // 启用插件
        Plugin::enable('HelloWorld', $renderer->getValues());

        // 激活插件
        \Plugins\Index\Main::enable();
        // 获取插件配置
        $renderer = new \Helpers\Renderer();
        \Plugins\Index\Main::config($renderer);
        // 启用插件
        Plugin::enable('Index', $renderer->getValues());

        // 激活插件
        \Plugins\Error\Main::enable();
        // 获取插件配置
        $renderer = new \Helpers\Renderer();
        \Plugins\Error\Main::config($renderer);
        // 启用插件
        Plugin::enable('Error', $renderer->getValues());

        // 激活插件
        \Plugins\Admin\Main::enable();
        // 获取插件配置
        $renderer = new \Helpers\Renderer();
        \Plugins\Admin\Main::config($renderer);
        // 启用插件
        Plugin::enable('Admin', $renderer->getValues());
    }

    public static function exceptionHandler($exception)
    {
        echo '服务器内部错误';
    }
}

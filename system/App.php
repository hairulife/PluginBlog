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
            //             'Content\Plugins\HelloWorld\Main::render'
            //         ]
            //     ]
            // ],
        ]);

        // 激活插件
        \Content\Plugins\HelloWorld\Main::activate();
        // 获取插件配置
        $renderer = new \Helpers\Renderer();
        \Content\Plugins\HelloWorld\Main::config($renderer);
        // 启用插件
        Plugin::enable('HelloWorld', $renderer->getValues());

        // 激活插件
        \Content\Plugins\Index\Main::activate();
        // 获取插件配置
        $renderer = new \Helpers\Renderer();
        \Content\Plugins\Index\Main::config($renderer);
        // 启用插件
        Plugin::enable('Index', $renderer->getValues());

        // 激活插件
        \Content\Plugins\Error\Main::activate();
        // 获取插件配置
        $renderer = new \Helpers\Renderer();
        \Content\Plugins\Error\Main::config($renderer);
        // 启用插件
        Plugin::enable('Error', $renderer->getValues());
    }

    public static function exceptionHandler($exception)
    {
        echo '服务器内部错误';
    }
}

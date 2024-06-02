<?php

namespace Content\Plugins\HelloWorld;

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
        Plugin::factory(__CLASS__)->run = __CLASS__ . '::start';
    }

    /**
     * 停用插件
     *
     * @return void
     */
    public static function deactivate()
    {
    }

    /**
     * 插件配置
     *
     * @param $renderer 渲染器
     * @return void
     */
    public static function config($renderer)
    {
        $renderer->setValue('api', 'https://api.oick.cn/dutang/api.php');
        $renderer->setTemplate(function ($data) {
            include __DIR__ . '/config.php';
        });
    }

    public static function start()
    {
        echo 'Hello World!';
    }

    public static function render()
    {
        include __DIR__ . '/views/copyright.php';
    }

    public static function script($data)
    {
        include __DIR__ . '/views/script.php';
    }
}

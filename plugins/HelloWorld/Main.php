<?php

namespace Plugins\HelloWorld;

use System\Plugin;

class Main
{
    public static function enable()
    {
        Plugin::factory(__CLASS__)->run = __CLASS__ . '::view';
    }

    public static function disable()
    {
    }

    public static function config($renderer)
    {
        $renderer->setValue('api', 'https://api.oick.cn/dutang/api.php');
        $renderer->setTemplate(function ($data) {
            include __DIR__ . '/config.php';
        });
    }

    public static function view()
    {
        echo 'Hello World';
    }
}

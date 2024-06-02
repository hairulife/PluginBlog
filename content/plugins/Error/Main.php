<?php

namespace Content\Plugins\Error;

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
        echo '404';
    }
}

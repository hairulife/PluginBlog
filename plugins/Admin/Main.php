<?php

namespace Plugins\Admin;

use System\Plugin;

class Main
{
    public static function enable()
    {
        Plugin::factory(__CLASS__)->run = Routes::class . '::dispatcher';
    }

    public static function disable()
    {
    }

    public static function config($renderer)
    {
    }
}

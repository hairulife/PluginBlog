<?php

namespace Plugins\Error;

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

    public static function config()
    {
    }

    public static function view()
    {
        echo '404';
    }
}

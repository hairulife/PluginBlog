<?php

namespace system;

use System\Medoo;

class Db
{
    public static $db;

    public static function init($config)
    {
        self::$db = new Medoo($config);
    }
}

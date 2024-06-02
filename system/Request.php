<?php

namespace System;

class Request
{
    private static $path;

    public static function getPath()
    {
        if (empty(self::$path)) {
            $name = $_SERVER['SCRIPT_NAME'] ? $_SERVER['SCRIPT_NAME'] : '/index.php';
            $path = str_replace($name, '', $_SERVER['REQUEST_URI']) ?: '/';
            $path = $path !== '/' ? rtrim($path, '/') : '/';
            $path = explode('?', $path)[0];
            // 转换为小写
            self::$path = strtolower($path);
        }

        return self::$path;
    }
}

<?php

namespace Helpers;

class Utils
{
    // 下划线转大驼峰
    public static function toCamelCase($str)
    {
        $str = ucwords(str_replace(['_', '-'], ' ', $str));
        $str = str_replace(' ', '', $str);

        return $str;
    }

    // 通过插件入口文件全路径获取插件名称
    public static function getPluginName($name)
    {
        $name = explode('\\', $name);
        return $name[count($name) - 2];
    }

    public static function getFullPluginName($name)
    {
        return 'Content\\Plugins\\' . $name . '\\Main';
    }
}

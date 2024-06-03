<?php

namespace App\Admin\Controllers;

use System\Utils;
use System\Response;

class Plugin
{
    public static $plugins = [];

    public static function get()
    {
        if (empty(self::$plugins)) {
            foreach (glob(ROOT_DIR . 'writable/plugins/*') as $file) {
                $pluginName =   pathinfo($file, PATHINFO_FILENAME);
                $class = Utils::getPluginFullName($pluginName);

                if (class_exists($class) && method_exists($class, 'enable')) {
                    self::$plugins[] = [
                        'name' => $pluginName,
                        'title' => $class::$info['title'] ?? $pluginName,
                        'version' => $class::$info['version'] ?? '1.0.0',
                        'description' => $class::$info['description'] ?? '',
                        'author' => $class::$info['author'] ?? '',
                        'url' => $class::$info['url'] ?? '',
                    ];
                }
            }
        }

        return self::$plugins;
    }

    public static function view($params)
    {
        $plugins = self::get();

        Response::renderAdmin('plugin', compact('plugins'));
    }
}

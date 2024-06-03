<?php

namespace App;

use System\Utils;
use System\Renderer;
use System\Plugin;

class Boot
{
    public static $plugins = [];

    public static function get()
    {
        if (empty(self::$plugins)) {
            foreach (glob(ROOT_DIR . 'app/*') as $file) {
                $pluginName =   pathinfo($file, PATHINFO_FILENAME);
                $class = Utils::getPluginFullName($pluginName, 'App');
                if (class_exists($class) && method_exists($class, 'enable')) {
                    self::$plugins[] = [
                        'name' => $pluginName,
                        'class' => $class,
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

    public static function init()
    {
        $plugins = self::get();

        foreach ($plugins as $plugin) {
            $plugin['class']::enable();
            $renderer = new Renderer();
            $plugin['class']::config($renderer);
            Plugin::enable($plugin['name'], $renderer->getValues());
        }
    }
}

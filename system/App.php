<?php

namespace {
    spl_autoload_register(function ($class) {
        $alias = ['System' => 'system', 'Plugins' => 'plugins'];

        $relativeClass = $class;
        $file = ROOT_DIR . str_replace('\\', '/', $relativeClass) . '.php';

        foreach ($alias as $prefix => $baseDir) {
            $len = strlen($prefix);
            if (strncmp($prefix, $class, $len) === 0) {
                $relativeClass = substr($class, $len);
                $file = ROOT_DIR . $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
                break;
            }
        }

        if (file_exists($file)) {
            require $file;
        }
    });
}

namespace System {

    use System\Plugin;

    class App
    {
        public static function init()
        {
            if (!(defined('DEBUG') && DEBUG)) {
                set_exception_handler(array(__CLASS__, 'exceptionHandler'));
            }

            // 初始化插件
            Plugin::init([
                // 'HelloWorld' => [
                //     'config' => [],
                //     'handles' => [
                //         'index.php:start' => [
                //             'Plugins\HelloWorld\Main::render'
                //         ]
                //     ]
                // ],
            ]);

            // 激活插件
            \Plugins\HelloWorld\Main::enable();
            // 获取插件配置
            $renderer = new \System\Renderer();
            \Plugins\HelloWorld\Main::config($renderer);
            // 启用插件
            Plugin::enable('HelloWorld', $renderer->getValues());

            // 激活插件
            \Plugins\Index\Main::enable();
            // 获取插件配置
            $renderer = new \System\Renderer();
            \Plugins\Index\Main::config($renderer);
            // 启用插件
            Plugin::enable('Index', $renderer->getValues());

            // 激活插件
            \Plugins\Error\Main::enable();
            // 获取插件配置
            $renderer = new \System\Renderer();
            \Plugins\Error\Main::config($renderer);
            // 启用插件
            Plugin::enable('Error', $renderer->getValues());

            // 激活插件
            \Plugins\Admin\Main::enable();
            // 获取插件配置
            $renderer = new \System\Renderer();
            \Plugins\Admin\Main::config($renderer);
            // 启用插件
            Plugin::enable('Admin', $renderer->getValues());
        }

        public static function exceptionHandler($exception)
        {
            echo '服务器内部错误';
        }
    }
}

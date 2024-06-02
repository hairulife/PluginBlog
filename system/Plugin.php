<?php

namespace System;

class Plugin
{
    // 数据库存储的插件列表
    private static $plugins = [
        // [
        //     'HelloWorld' => [
        //         'config' => [],
        //         'handlers' => [
        //             'index.php:start' => [
        //                 'Plugins\HelloWorld\Main::render'
        //             ]
        //         ]
        //     ],
        // ]
    ];

    // 插件执行的方法列表
    private static $handlers = [
        // 'index.php:begin' => [
        //     'Plugins\HelloWorld\Main::render'
        // ]
    ];

    // 临时存储
    private static $tmp = [];

    // 插件配置
    private static $configs = [
        // 'HelloWorld' => []
    ];

    // 当前手柄
    private $handle;

    public function __construct($handle)
    {
        $this->handle = $handle;
    }

    // 初始化插件
    public static function init($plugins)
    {
        self::$plugins = $plugins;
        self::$configs = array_reduce(array_keys($plugins), function ($carry, $item) {
            return array_merge_recursive($carry, [$item => self::$plugins[$item]['config']]);
        }, []);
        self::$handlers = array_reduce($plugins, function ($carry, $item) {
            return array_merge_recursive($carry, $item['handles']);
        }, []);
    }

    // 创建插件钩子、获取插件配置
    public static function factory($handle)
    {
        return new self($handle);
    }

    // 执行插件方法
    public function __call($method, $args)
    {
        $handler = $this->handle . ':' . $method;

        if (isset(self::$handlers[$handler])) {
            foreach (self::$handlers[$handler] as $callback) {
                call_user_func_array($callback, array_merge($args, [
                    self::$configs[\Helpers\Utils::getPluginName($callback)]
                ]));
            }
        }
    }

    // 设置插件
    public function __set($name, $value)
    {
        $handler = $this->handle . ':' . $name;

        self::$tmp = array_merge_recursive(self::$tmp, [
            $handler => [$value]
        ]);
    }

    // 启用当前插件
    public static function enable($name, $config)
    {
        self::$plugins[$name] = [
            'config' => $config,
            'handles' => self::$tmp
        ];

        self::init(self::$plugins);

        self::$tmp = [];
    }

    // 导出已激活的插件
    public static function export()
    {
        return self::$plugins;
    }

    // 是否存在插件
    public static function exists($name)
    {
        return isset(self::$plugins[$name]);
    }

    // 是否存在操作
    public static function existsHandler($handler)
    {
        return isset(self::$handlers[$handler]);
    }
}

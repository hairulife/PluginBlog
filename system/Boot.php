<?php

namespace {
    function autoload($class)
    {
        $alias = [
            'System' => 'system',
            'Plugins' => 'plugins',
            'Themes' => 'themes',
        ];

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
    }
}

namespace System {
    class Boot
    {
        public static function init()
        {
            spl_autoload_register('autoload');
        }
    }
}

<?php

namespace Plugins\Admin;

use System\Request;
use System\Utils;
use Plugins\Error\Main as Error;

class Routes
{
    public static function dispatcher()
    {
        $action = explode('/', Request::getPath())[2] ?? 'index';
        $params = array_slice(explode('/', Request::getPath()), 3);
        $class = __NAMESPACE__ . '\\Controllers\\' . Utils::toCamelCase($action);

        if (class_exists($class) && method_exists($class, 'view')) {
            call_user_func([$class, 'view'], $params);
        } else {
            \System\Plugin::factory(Error::class)->run();
        }
    }
}

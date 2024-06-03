<?php

namespace App\Admin\Controllers;

class Index
{
    public static function view()
    {
        echo '后台首页<a href="/admin/plugin">插件管理</a>';
    }
}

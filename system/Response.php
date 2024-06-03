<?php

namespace System;

class Response
{
    public static function renderAdmin($view, $data = [])
    {
        $views = is_array($view) ? $view : [$view];

        header('Content-Type: text/html; charset=utf-8');
        ob_start();
        extract($data);

        foreach ($views as $view) {
            $filePath = ROOT_DIR . 'views/admin/' . $view . '.php';
            if (file_exists($filePath)) {
                include_once $filePath;
            }
        }

        $html = ob_get_contents();
        ob_end_clean();

        echo $html;
    }
}

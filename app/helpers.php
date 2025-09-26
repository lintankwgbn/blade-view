<?php

use App\Libraries\Blade;

if (! function_exists('view')) {
    /**
     * Get the evaluated contents of the given view.
     * @param string $view
     * @param array $data
     * @return string
     */
    function view(string $view, array $data = [])
    {
        $cachePath = __DIR__ . '/cache';
        $viewsPath = __DIR__ . '/views';
        $blade = new Blade($cachePath, $viewsPath);

        return $blade->render($view, $data);
    }
}

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
        $viewsPath = __DIR__ . '/views';
        $cachePath = dirname(__DIR__) . '/cache';
        $blade = new Blade($viewsPath, $cachePath);

        return $blade->render($view, $data);
    }
}

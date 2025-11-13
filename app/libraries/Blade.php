<?php

namespace App\Libraries;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

class Blade
{
    /**
     * View factory instance.
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $factory;

    /**
     * Create a new blade instance.
     * @param mixed $viewsPath
     * @param string $cachePath
     */
    public function __construct(mixed $viewsPath, string $cachePath)
    {
        $files = new Filesystem();
        $engines = new EngineResolver();
        $phpEngine = new PhpEngine($files);
        $engines->register('php', fn () => $phpEngine);
        $compiler = new BladeCompiler($files, $cachePath);
        $compilerEngine = new CompilerEngine($compiler, $files);
        $engines->register('blade', fn () => $compilerEngine);
        $paths = is_array($viewsPath) ? $viewsPath : [$viewsPath];
        $finder = new FileViewFinder($files, $paths);
        $events = new Dispatcher(new Container());
        $this->factory = new Factory($engines, $finder, $events);
    }

    /**
     * Get the evaluated view contents for the given view.
     * @param string $view
     * @param array $data
     * @param array $mergeData
     * @return \Illuminate\Contracts\View\View
     */
    public function make(string $view, array $data = [], array $mergeData = [])
    {
        return $this->factory->make($view, $data, $mergeData);
    }

    /**
     * Get the evaluated contents of the object.
     * @param string $view
     * @param array $data
     * @return string
     */
    public function render(string $view, array $data = [])
    {
        return $this->make($view, $data)->render();
    }
}

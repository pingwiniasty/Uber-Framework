<?php

namespace Core\Providers;

use Twig_Loader_Filesystem;
use Twig_Environment;

/**
 * Here is some comment
 *
 * Class TwigServiceProvider
 *
 * @category MyCategory
 *
 * @package Core\Providers
 *
 * @author Original Author <kamil.ubermade@gmail.com>
 *
 * @license The MIT License (MIT)
 *
 * @link https://github.com/Ubermade/mvc-engine
 */
class TwigServiceProvider extends ServiceProvider
{
    /**
     * @param array $options
     * @return Twig_Environment
     */
    public function provide(array $options = []): ?Twig_Environment
    {
        $loader = new Twig_Loader_Filesystem($this->config['dir']);
        $twig = new Twig_Environment($loader, array(
            'cache' => $this->config['cache'],
            'auto_reload' => true
        ));

        return $twig;
    }
}
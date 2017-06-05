<?php

namespace Cable\View;


use Cable\Config\Config;
use Cable\Container\ServiceProvider;
use Cable\View\Driver\TwigDriverInterface;

class TwigServiceProvider extends ServiceProvider
{

    /**
     * register new providers or something
     *
     * @return mixed
     */
    public function boot()
    {

    }

    /**
     * register the content
     *
     * @return mixed
     */
    public function register()
    {
        $app = $this->getContainer();

        $app->singleton(\Twig_Loader_Filesystem::class, function () use ($app) {
            return new \Twig_Loader_Filesystem($app[Config::class]->get('view.path', 'app/view/'));
        });

        $app->singleton(
            \Twig_Environment::class,
            function () use ($app) {
                return new \Twig_Environment($app[\Twig_Loader_Filesystem::class], array(
                    $app[Config::class]->get('view.cache', 'storage/cache/')
                ));
            }
        );


        // save driver
        $app->add('view.twig', function () use ($app){
            $twig = $app[TwigDriver::class];

            $twig->boot($app[Config::class]->get('view.twig', []));

            return $twig;
        });

        // save alias
        $app->alias(TwigDriverInterface::class, 'view.twig');
    }
}

<?php

namespace Cable\View;


use Cable\Config\Config;
use Cable\Container\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{

    /**
     * register new providers or something
     *
     * @return mixed
     */
    public function boot()
    {
        $this->getContainer()
            ->addProvider(BladeServiceProvider::class);
    }

    /**
     * register the content
     *
     * @return mixed
     */
    public function register()
    {
        $app = $this->getContainer();
        $app->singleton(View::class, View::class);

        // lets save driver
        $app->singleton('view', function ($app){
            $default = $app[Config::class]->get('view.driver', 'blade');

            return $app->driver($default);
        });
    }
}

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

        // lets save driver
        $app->add('view', function () use ($app){
            $default = $app[Config::class]->get('view.driver', 'blade');

            return $app->resolve(View::class)->driver($default);
        });
    }
}

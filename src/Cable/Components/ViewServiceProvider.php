<?php

namespace Cable\View;


use Cable\Config\Config;
use Cable\Container\ProviderException;
use Cable\Container\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{

    /**
     * register new providers or something
     *
     * @throws ProviderException
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
        $app->add('view', function (){
            $default = $this->getContainer()
                ->make(Config::class)
                ->get('view.driver', 'blade');

            return $this->getContainer()->resolve(View::class)->driver($default);
        });
    }
}

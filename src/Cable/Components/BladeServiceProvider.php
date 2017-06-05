<?php
namespace Cable\View;

use Cable\Config\Config;
use Cable\Container\ServiceProvider;
use Philo\Blade\Blade;

/**
 * Class BladeServiceProvider
 * @package Cable\View
 */
class BladeServiceProvider extends ServiceProvider
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

        $app->singleton(Blade::class, function () use ($app){
            $config = $app[Config::class];


            return new Blade(
                $config->get('view.path', 'app/views'),
                $config->get('view.cache', 'storage/cache')
            );
        });

        $app->add('view.blade', BladeDriver::class);
        $app->alias(BladeDriverInterface::class, 'view.blade');
        $app->alias(BladeDriver::class, 'view.blade');
    }
}

<?php

namespace Cable\View\Facade;


use Cable\Facade\Facade;

class View extends Facade
{

    /**
     * @return \Cable\View\View
     */
    public static function getFacadeClass()
    {
        return static::$container->resolve('view');
    }

}
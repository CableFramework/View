<?php

namespace Cable\View;

use Cable\Container\ContainerInterface;
use Cable\Container\ExpectationException;
use Cable\Container\NotFoundException;

/**
 * Created by PhpStorm.
 * User: My
 * Date: 06/05/2017
 * Time: 05:23
 */
class View
{

    /**
     * @var \Cable\Config\Config
     */
    private $config;


    /**
     * @var string
     */
    private $driverAlias = 'view';

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * View constructor.
     * @param Config $config
     */
    public function __construct(Config $config, ContainerInterface $container)
    {
        $this->config = $config;
        $this->container = $container;
    }

    /**
     * @param string $driver
     * @return mixed
     * @throws DriverException
     * @throws \ReflectionException
     * @throws ExpectationException
     */
    public function driver($driver)
    {
        $name = $this->driverAlias.'.'.$driver;


        try {
            $driver = $this->container->resolve($name);


            if ($driver instanceof BootableDriverInterface) {
                $driver->boot($this->config->get('view.'.$driver, []));
            }

            return $driver;
        } catch (NotFoundException $exception) {
            throw new DriverException(
                sprintf(
                    '%s driver could not found',
                    $driver
                )
            );
        }
    }


}

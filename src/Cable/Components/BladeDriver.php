<?php

namespace Cable\View;


use Cable\View\Driver\DriverInterface;
use Philo\Blade\Blade;

/**
 * Class BladeDriver
 * @package Cable\View
 */
class BladeDriver implements DriverInterface
{

    /**
     */
    private $blade;

    /**
     * @var array
     */
    private $args = [];

    /**
     * @var array
     */
    private static  $share = [];

    /**
     * BladeDriver constructor.
     * @param Blade $blade
     */
    public function __construct(Blade $blade)
    {
        $this->blade = $blade->view();
    }


    /**
     * @param array $args
     * @return $this
     */
    public function withArgs(array $args = [])
    {
        $this->args = array_merge($this->args, $args);

        return $this;
    }

    /**
     * @param string $name
     * @param null $value
     * @return $this
     */
    public function with($name, $value = null)
    {
        $this->args[$name] = $value;

        return $this;
    }

    /**
     * @param strimg $name
     * @param array $args
     * @return string
     */
    public function make($name, array $args = [])
    {
        $this->withArgs($args);

        return $this->blade->make($name,array_merge($this->args, static::$share));
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function share($name, $value = null)
    {
        static::$share[$name] = $value;

        return $this;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array(
            array($this->blade, $name),
            $arguments
        );
    }
}

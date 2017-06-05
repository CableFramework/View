<?php

namespace Cable\View;


use Cable\View\Driver\DriverInterface;
use Cable\View\Driver\TwigDriverInterface;

class TwigDriver implements DriverInterface, TwigDriverInterface, BootableDriverInterface
{

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var array
     */
    private $args = [];


    /**
     * @var string
     */
    private $selectedExt = '.html';

    /**
     * TwigDriver constructor.
     * @param \Twig_Environment $environment
     */
    public function __construct(\Twig_Environment $environment)
    {
        $this->twig = $environment;
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
     * @param string $name
     * @param null $value
     * @return $this
     */
    public function share($name, $value = null)
    {
        $this->twig->addGlobal($name, $value);

        return $this;
    }

    /**
     * @param array $args
     * @return $this
     */
    public function withArgs(array $args = [])
    {
        $this->args = array_merge($args, $this->args);

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

        $name = $name.'.'.$this->selectedExt;

        return $this->twig->render($name, $args);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function boot(array $options = [])
    {
        if (isset($options['extension'])) {
            $this->selectedExt = $options['extension'];
        }
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array(array(
            $this->twig, $name
        ), $arguments);
    }
}

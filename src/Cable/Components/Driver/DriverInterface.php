<?php
namespace Cable\View\Driver;


interface DriverInterface
{

    /**
     * @param array $args
     * @return $this
     */
    public function withArgs(array  $args = []);
    /**
     * @param string $name
     * @param null $value
     * @return $this
     */
    public function with($name, $value = null);

    /**
     * @param strimg $name
     * @param array $args
     * @return string
     */
    public function make($name, array $args = []);

    /**
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function share($name, $value = null);
}


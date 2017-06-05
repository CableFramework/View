<?php

namespace Cable\View;


interface BootableDriverInterface
{

    /**
     * @param array $options
     * @return mixed
     */
    public function boot(array $options = []);
}
